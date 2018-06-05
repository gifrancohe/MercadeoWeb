<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Venta */

$this->title = $model->id_venta;
$this->params['breadcrumbs'][] = ['label' => 'Ventas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venta-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id_venta], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_venta',
            [
                'attribute' => 'Tendero',
                'value' => $model->tendero->nombre,
            ],
            [
                'attribute' => 'Producto',
                'value' => $model->producto->nombre,
            ],
            [
                'attribute' => 'Presentacion',
                'value' => $model->presentacion->descripcion,
            ],
            'precio.precio',
            'cantidad',
            'fecha_venta',
        ],
    ]) ?>

</div>
