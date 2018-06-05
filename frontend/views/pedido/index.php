<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PedidoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pedidos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Generar Pedido', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_pedido',
            [
                'attribute' => 'Producto',
                'value' => 'producto.nombre',
            ],
            [
                'attribute' => 'Presentacion',
                'value' => 'presentacion.descripcion',
            ],
            'precio.precio',
            [
                'attribute' => 'Tendero',
                'value' => 'tendero.nombre',
            ],
            'cantidad',
            'fecha_pedido',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=> '{view}',
            ],
        ],
    ]); ?>
</div>
