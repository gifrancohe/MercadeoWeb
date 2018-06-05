<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\Municipio;
use yii\helpers\ArrayHelper;
use app\models\Tendero;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cliente-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'municipio_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Municipio::find()->where(['estado' => 1])->all(), 'id_municipio', 'municipio'),
            'language' => 'es',
            'options' => ['placeholder' => 'Seleccione el municipio ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?= $form->field($model, 'tendero_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Tendero::find()->all(), 'id_tendero', 'nombre'),
            'language' => 'es',
            'options' => ['placeholder' => 'Seleccione el tendero ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?= $form->field($model, 'user_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(User::find()->all(), 'id', 'username'),
            'language' => 'es',
            'options' => ['placeholder' => 'Seleccione el usuario del cliente ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
