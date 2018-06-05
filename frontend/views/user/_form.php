<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'municipio_id')->widget(Select2::classname(), [
            'data' => $municipios,
            'language' => 'es',
            'options' => ['placeholder' => 'Seleccione el Municipio ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?= $form->field($model, 'tipo_usuario_id')->widget(Select2::classname(), [
            'data' => $tipoUsuarios,
            'language' => 'es',
            'options' => ['placeholder' => 'Seleccione el tipo de usuario ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?= $form->field($model, 'status')->widget(Select2::classname(), [
            'data' => [10 => 'Activo', 0 => 'Inactivo'] ,
            'language' => 'es',
            'options' => ['placeholder' => 'Seleccione el estado ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Actualizar', ['class' => 'btn btn-success']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>

    


