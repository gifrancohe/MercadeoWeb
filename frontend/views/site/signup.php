<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Registrarse';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

               <?= $form->field($model, 'nombre')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'apellido')->textInput() ?>

                <?= $form->field($model, 'cedula')->textInput() ?>

                <?= $form->field($model, 'direccion')->textInput() ?>

                <?= $form->field($model, 'telefono')->textInput() ?>

                <?= $form->field($model, 'municipio_id')->textInput() ?>

                <?= $form->field($model, 'tipo_usuario_id')->textInput() ?>

                <?= $form->field($model, 'username')->textInput() ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
