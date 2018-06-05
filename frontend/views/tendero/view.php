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
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_tendero',
            'municipio.municipio',
            [
                'attribute' => 'Punto de Venta',
                'value' => $model->puntoVenta->nombre,
            ],
            [
                'attribute' => 'Usuario',
                'value' => $model->user->username,
            ],
            'nombre',
            'nit',
            'direccion',
            'telefono',
        ],
    ]) ?>

</div>
