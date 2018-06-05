<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PuntoVenta */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Puntos de Venta', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="punto-venta-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id_punto_venta], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_punto_venta',
            'municipio.municipio',
            'nombre',
            'nit',
            'direccion',
            'telefono',
            'barrio',
        ],
    ]) ?>

</div>
