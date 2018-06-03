<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PuntoVenta */

$this->title = 'Actualizar Punto de Venta: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Puntos de Venta', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->id_punto_venta]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="punto-venta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
