<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Venta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estadistica-form">

    <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <h4> Ingrese el período de tiempo para los reportes </h4>
        </div>

        <div class="row">

            <div class="col-lg-6">
                <?php 
                    echo '<label>Fecha Inicio</label>';
                    echo DatePicker::widget([
                        'name' => 'Venta[fecha_inicio]',  
                        'value' => date('Y-m-d'),
                        'options' => ['placeholder' => 'Seleccione la fecha de Inicio...'],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'todayHighlight' => true
                        ]
                    ]);
                ?>
            </div>
            <div class="col-lg-6">                
                <?php 
                    echo '<label>Fecha Fin</label>';
                    echo DatePicker::widget([
                        'name' => 'Venta[fecha_fin]',  
                        'value' => date('Y-m-d'),
                        'options' => ['placeholder' => 'Seleccione la fecha de fin...'],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'todayHighlight' => true
                        ]
                    ]);
                ?>
            </div>    
        </div>
        <br>
    

    <div class="form-group">
        <?= Html::submitButton('Consultar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

        <?php if(!empty($data)):?>
            <div class="row">
                <h4 style="text-align: center;"> Tabla de Ventas </h4>                
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Presentación</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Fecha Venta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['ventas'] as $venta):?>
                            <tr>
                                <th scope="row"><?= $venta->id_venta ?></th>
                                <td><?= $venta->producto->nombre ?></td>
                                <td><?= $venta->presentacion->descripcion ?></td>
                                <td><?= '$ '.$venta->precio->precio ?></td>
                                <td><?= $venta->cantidad ?></td>
                                <td><?= $venta->fecha_venta ?></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
            <div class="row" style="font-size: 12pt;">
                <div class="col-lg-4">
                    <span><b>Producto más vendido</b>:</span>
                    <?= $data['producto_mas_vendido']->nombre; ?>
                </div>
                <div class="col-lg-4">
                    <span><b>Total Ventas</b>:</span>
                    <?= $data['total_prod_mas_ventas']; ?>
                </div>
            </div>
            <div class="row" style="font-size: 12pt;">
                <div class="col-lg-4">
                    <span><b>Producto menos vendido</b>:</span>
                    <?= $data['producto_menos_vendido']->nombre; ?>
                </div>
                <div class="col-lg-4">
                    <span><b>Total Ventas</b>:</span>
                    <?= $data['total_prod_menos_ventas']; ?>
                </div>
            </div>
            <div class="row" style="font-size: 12pt;">
                <div class="col-lg-4">
                    <span><b>Presentación más vendida</b>:</span>
                    <?= $data['presentacion_mas_id']->descripcion; ?>
                </div>
                <div class="col-lg-4">
                    <span><b>Veces que se vendio</b>:</span>
                    <?= $data['presentacion_mas_total']; ?>
                </div>
            </div>
            <div class="row" style="font-size: 12pt;">
                <div class="col-lg-4">
                    <span><b>Presentación menos vendida</b>:</span>
                    <?= $data['presentacion_menos_id']->descripcion; ?>
                </div>
                <div class="col-lg-4">
                    <span><b>Veces que se vendio</b>:</span>
                    <?= $data['presentacion_menos_total']; ?>
                </div>
            </div>
            <div class="row" style="font-size: 12pt;">
                <h3> Información de puntos de venta </h3>
            </div>
            <div class="row" style="font-size: 12pt;">
                <div class="col-lg-6" style="color:green;">
                    <h4> Mayor Venta </h4>
                </div>
                <div class="col-lg-6" style="color:red;">
                    <h4> Menor Venta </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Establecimiento</th>
                                <th scope="col">Ciudad</th>
                                <th scope="col">Barrio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th><?= $data['punto_venta_mas']->nombre ?></th>
                                <td><?= $data['punto_venta_mas']->municipio->municipio ?></td>
                                <td><?= $data['punto_venta_mas']->barrio ?></td>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-6">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Establecimiento</th>
                                <th scope="col">Ciudad</th>
                                <th scope="col">Barrio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th><?= $data['punto_venta_menos']->nombre ?></th>
                                <td><?= $data['punto_venta_menos']->municipio->municipio ?></td>
                                <td><?= $data['punto_venta_menos']->barrio ?></td>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif;?>

</div>
