<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tendero */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Tenderos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tendero-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id_tendero], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id_tendero], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_tendero',
            'municipio_id',
            'punto_venta_id',
            'user_id',
            'nombre',
            'nit',
            'direccion',
            'telefono',
        ],
    ]) ?>

</div>
