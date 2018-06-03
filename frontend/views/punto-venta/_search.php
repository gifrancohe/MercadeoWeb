<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PuntoVentaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="punto-venta-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_punto_venta') ?>

    <?= $form->field($model, 'municipio_id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'nit') ?>

    <?= $form->field($model, 'direccion') ?>

    <?php // echo $form->field($model, 'telefono') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
