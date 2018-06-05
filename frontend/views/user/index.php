<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'username',
            //'email:email',
            'nombre',
            'apellido',
            'cedula',
            'direccion',
            'telefono',
            [
                'attribute'=>'status',
                'header'=>'Estado',
                'filter' => [10=>'Activo', 0=>'Inactivo'],
                'format'=>'raw',    
                'value' => function($model, $key, $index)
                {   
                    if($model->status == 10)
                    {
                        return 'Activo';
                    }
                    else
                    {   
                        return 'Inactivo';
                    }
                },
            ],
            'municipio.municipio',
            'tipoUsuario.tipo_usuario',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            //'created_at',
            //'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
