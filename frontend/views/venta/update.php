<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Venta */

$this->title = 'Actualizar Venta: ' . $model->id_venta;
$this->params['breadcrumbs'][] = ['label' => 'Ventas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_venta, 'url' => ['view', 'id' => $model->id_venta]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="venta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tenderos' => $tenderos,
        'productos' => $productos,
        'precios' => $precios,
        'presentaciones' => $presentaciones,
        'error' => $error,
    ]) ?>

</div>
