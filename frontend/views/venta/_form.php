<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Venta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="venta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'producto_id')->widget(Select2::classname(), [
            'data' => $productos,
            'language' => 'es',
            'options' => ['placeholder' => 'Seleccione el producto ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?= $form->field($model, 'presentacion_id')->widget(Select2::classname(), [
            'data' => $presentaciones,
            'language' => 'es',
            'options' => ['placeholder' => 'Seleccione la presentación ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?= $form->field($model, 'precio_id')->widget(Select2::classname(), [
            'data' => $precios,
            'language' => 'es',
            'options' => ['placeholder' => 'Seleccione el precio ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?= $form->field($model, 'cantidad')->textInput() ?>

    <?= $form->field($model, 'fecha_venta')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
