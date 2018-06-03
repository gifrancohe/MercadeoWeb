<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\PuntoVenta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="punto-venta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'municipio_id')->widget(Select2::classname(), [
            'data' => $municipios,
            'language' => 'es',
            'options' => ['placeholder' => 'Seleccione el Municipio ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>