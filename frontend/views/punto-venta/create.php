<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PuntoVenta */

$this->title = 'Crear Punto de Venta';
$this->params['breadcrumbs'][] = ['label' => 'Puntos de Venta', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="punto-venta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'municipios' => $municipios,
    ]) ?>

</div>
