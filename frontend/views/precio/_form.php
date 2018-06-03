<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Precio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="precio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'precio')->textInput() ?>

    <?php if(!$model->isNewRecord): ?>

        <?= $form->field($model, 'estado')->textInput() ?>
    
        <?= $form->field($model, 'fecha_creacion')->textInput() ?>

    <?php endif;?>        

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
