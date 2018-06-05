<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pedido */

$this->title = $model->id_pedido;
$this->params['breadcrumbs'][] = ['label' => 'Pedidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_pedido',
            [
                'attribute' => 'Producto',
                'value' => $model->producto->nombre,
            ],
            [
                'attribute' => 'Presentacion',
                'value' => $model->presentacion->descripcion,
            ],
            'precio.precio',
            [
                'attribute' => 'Tendero',
                'value' => $model->tendero->nombre,
            ],
            'cantidad',
            'fecha_pedido',
        ],
    ]) ?>

</div>
