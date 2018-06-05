<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\OutletSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Outlets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outlet-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Outlet', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_outlet',
            [
                'attribute' => 'Producto',
                'value' => 'producto.nombre',
            ],
            'municipio.municipio',
            [
                'attribute'=>'estado',
                'header'=>'Estado',
                'filter' => [1=>'Activo', 0=>'Inactivo'],
                'format'=>'raw',    
                'value' => function($model, $key, $index)
                {   
                    if($model->estado == 1)
                    {
                        return 'Activo';
                    }
                    else
                    {   
                        return 'Inactivo';
                    }
                },
            ],
            'create_at',
            //'update_at',

            [   
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
