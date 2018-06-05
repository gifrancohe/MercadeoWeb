<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\Municipio;
use yii\helpers\ArrayHelper;
use app\models\Tendero;
use common\models\User;


?>

<div class="cliente-form">

    <?php $form = ActiveForm::begin(); ?>

        <?=  Html::hiddenInput('generar', 1); ?>

        <h4> Para ejecutar el comando que genera la Base de Datos, 
        debe hacer clic sobre el bóton generar. </h4>

    
    <div class="form-group">
        <?= Html::submitButton('Generar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
