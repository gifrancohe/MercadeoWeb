<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Outlet */

$this->title = 'Crear Outlet';
$this->params['breadcrumbs'][] = ['label' => 'Outlets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outlet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
