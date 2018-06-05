<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TenderoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tenderos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tendero-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Tendero', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_tendero',
            'nombre',
            'nit',
            'direccion',
            'telefono',
            'municipio.municipio',
            [
                'attribute' => 'Punto de Venta',
                'value' => 'puntoVenta.nombre',
            ],
            //'user_id',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
