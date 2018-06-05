<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\Producto;
use yii\helpers\ArrayHelper;
use app\models\Municipio;

/* @var $this yii\web\View */
/* @var $model app\models\Outlet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="outlet-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'producto_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Producto::find()->where(['estado' => 1])->all(), 'id_producto', 'nombre'),
            'language' => 'es',
            'options' => ['placeholder' => 'Seleccione el producto ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?= $form->field($model, 'municipio_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Municipio::find()->where(['estado' => 1])->all(), 'id_municipio', 'municipio'),
            'language' => 'es',
            'options' => ['placeholder' => 'Seleccione el municipio ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?= $form->field($model, 'descuento')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'estado')->widget(Select2::classname(), [
            'data' => [1 => 'Activo', 2 => 'Inactivo'],
            'language' => 'es',
            'options' => ['placeholder' => 'Seleccione el estado ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Crear', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
