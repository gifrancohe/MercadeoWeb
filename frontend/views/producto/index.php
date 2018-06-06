<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Productos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Producto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_producto',
            'nombre',
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
            'fecha_creacion',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
