<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Outlet */

$this->title = 'Actualizar Outlet: ' . $model->id_outlet;
$this->params['breadcrumbs'][] = ['label' => 'Outlets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_outlet, 'url' => ['view', 'id' => $model->id_outlet]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="outlet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
