<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PuntoVentaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Puntos de Venta';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="punto-venta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Punto de Venta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_punto_venta',
            'municipio.municipio',
            'nombre',
            'nit',
            'direccion',
            'telefono',
            'barrio',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
