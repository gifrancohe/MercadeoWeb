<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Precio */

$this->title = 'Actualizar Precio: ' . $model->precio;
$this->params['breadcrumbs'][] = ['label' => 'Precios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->precio, 'url' => ['view', 'id' => $model->id_precio]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="precio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
