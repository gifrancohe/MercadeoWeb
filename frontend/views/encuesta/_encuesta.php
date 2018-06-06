<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use app\models\Producto;
use app\models\PuntoVenta;

/* @var $this yii\web\View */
/* @var $model app\models\Encuesta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="encuesta-form">

    <?php if(!$encuesta_respuestas):?>

        <?php $form = ActiveForm::begin(); ?>

        <?php foreach($model as $key => $pregunta):?>
            
            <?php if($key == 1):?>
                <div id="view-questions" sytle="display: block;">
            <?php endif;?>
                <div class="row">
                    <?= "<b>Pregunta #".($key+1)."</b>" ?>
                </div>
                <div class="row">
                    <?= "¿ ". $pregunta->pregunta ." ?" ?>
                </div>
                <br>
                <?php 
                    switch($key) {
                        case 0:
                            echo Select2::widget([
                                'name' => "Encuesta[$pregunta->id_encuesta]", 
                                'value' => 1,
                                'data' => [1 => 'SI', 2 => 'NO'],
                                'options' => [
                                    'placeholder' => 'Seleccione la respuesta ...', 
                                    'id' => 'pregunta1',
                                    'onchange' => '
                                        var value = $(this).val();
                                        if(value == 2) {
                                            $("#view-questions").hide();
                                        }else{
                                            $("#view-questions").show();
                                        }
                                    '
                                ]
                            ]);
                            break;
                        case 1:
                            echo Select2::widget([
                                'name' => "Encuesta[$pregunta->id_encuesta]", 
                                'value' => '', 
                                'data' => ArrayHelper::map(Producto::find()->All(), 'id_producto', 'nombre'),
                                'options' => ['multiple' => true,'placeholder' => 'Seleccione la respuesta ...']
                            ]);
                            break;
                        case 2:
                            echo Select2::widget([
                                'name' => "Encuesta[$pregunta->id_encuesta]", 
                                'value' =>1, 
                                'data' => [
                                    1 => 'Diariamente.', 
                                    2 => 'Entre una y tres veces por semana.',
                                    3 => 'Entre cuatro y seis veces por semana.',
                                    4 => 'Una vez al mes.',
                                    5 => 'Más de una vez al mes.',
                                ],
                                'options' => ['placeholder' => 'Seleccione la respuesta ...']
                            ]);
                            break;
                        case 3:
                            echo Select2::widget([
                                'name' => "Encuesta[$pregunta->id_encuesta]", 
                                'value' =>1, 
                                'data' => [
                                    1 => 'Por unidad.', 
                                    2 => '250 gr (1/2 libra).',
                                    3 => '500 gr (1 libra).',
                                    4 => '750 gr (1 1/2 libra).',
                                    5 => '1000 gr (1 Kilogramo).',
                                ],
                                'options' => ['placeholder' => 'Seleccione la respuesta ...']
                            ]);
                            break;
                        case 4:
                            echo "
                                <div class='row'>
                                    <div class='col-lg-2'>
                                        <ul>
                                            <li>Precio</li>
                                        </ul>
                                    </div>
                                    <div class='col-lg-2'>".
                                        Html::textInput("Encuesta[$pregunta->id_encuesta][1][]", 1, ['class' => 'form-control']). 
                                    "</div>
                                </div>
                                <div class='row'>
                                    <div class='col-lg-2'>
                                        <ul>
                                            <li>Sabor</li>
                                        </ul>
                                    </div>
                                    <div class='col-lg-2'>".
                                        Html::textInput("Encuesta[$pregunta->id_encuesta][2][]", 2, ['class' => 'form-control']). 
                                    "</div>
                                </div>
                                <div class='row'>
                                    <div class='col-lg-2'>
                                        <ul>
                                            <li>Calidad</li>
                                        </ul>
                                    </div>
                                    <div class='col-lg-2'>".
                                        Html::textInput("Encuesta[$pregunta->id_encuesta][3][]", 3, ['class' => 'form-control']). 
                                    "</div>
                                </div>
                                <div class='row'>
                                    <div class='col-lg-2'>
                                        <ul>
                                            <li>Presentación</li>
                                        </ul>
                                    </div>
                                    <div class='col-lg-2'>".
                                        Html::textInput("Encuesta[$pregunta->id_encuesta][4][]", 4, ['class' => 'form-control']). 
                                    "</div>
                                </div>
                                <div class='row'>
                                    <div class='col-lg-2'>
                                        <ul>
                                            <li>Empaque</li>
                                        </ul>
                                    </div>
                                    <div class='col-lg-2'>".
                                        Html::textInput("Encuesta[$pregunta->id_encuesta][5][]", 5, ['class' => 'form-control']). 
                                    "</div>
                                </div>
                            ";
                            break;
                        case 5:
                            echo Select2::widget([
                                'name' => "Encuesta[$pregunta->id_encuesta]", 
                                'value' =>1, 
                                'data' => ArrayHelper::map(PuntoVenta::find()->All(), 'id_punto_venta', 'nombre', 'barrio'),
                                'options' => ['placeholder' => 'Seleccione la respuesta ...']
                            ]);
                            break;
                        case 6:
                            echo Select2::widget([
                                'name' => "Encuesta[$pregunta->id_encuesta]", 
                                'value' =>1, 
                                'data' => [
                                    1 => 'En el punto de compra habitual.',
                                    2 => 'Domicilio, solicitado telefónicamente al punto habitual de compra.',
                                    3 => 'Domicilio, solicitado a través de página web.',
                                    4 => 'En almacén de cadena (grandes superficies).'
                                ],
                                'options' => ['placeholder' => 'Seleccione la respuesta ...']
                            ]);
                            break;
                        case 7:
                            echo Select2::widget([
                                'name' => "Encuesta[$pregunta->id_encuesta]", 
                                'value' => 1,
                                'data' => [1 => 'SI', 2 => 'NO'],
                                'options' => ['placeholder' => 'Seleccione la respuesta ...']
                            ]);
                            break;
                    }
                ?>
                <br>
                <?php if($key == 6):?>
                    </div>
                <?php endif;?>
        <?php endforeach;?>
        
        <div class="form-group">
            <?= Html::submitButton('Enviar respuestas', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    <?php endif;?>

</div>

<?php 
    $this->registerJs(' 
        function hideQuestion(element){
            alert(element);
        };
    ', \yii\web\View::POS_READY);
?>
