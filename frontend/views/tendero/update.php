<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tendero */

$this->title = 'Actualizar Tendero: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Tenderos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->id_tendero]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="tendero-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'municipios' => $municipios,
        'puntos' => $puntos,
        'usuarios' => $usuarios,
    ]) ?>

</div>
