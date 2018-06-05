<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\VentaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ventas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Registrar Venta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_venta',
            [
                'attribute' => 'Tendero',
                'value' => 'tendero.nombre',
            ],
            [
                'attribute' => 'Producto',
                'value' => 'producto.nombre',
            ],
            [
                'attribute' => 'Presentacion',
                'value' => 'presentacion.descripcion',
            ],
            'precio.precio',
            'cantidad',
            'fecha_venta',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}', 
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
