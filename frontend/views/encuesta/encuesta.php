<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Encuesta */

$this->title = 'Diligenciar Encuesta';
$this->params['breadcrumbs'][] = ['label' => 'Encuestas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="encuesta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_encuesta', [
        'model' => $model,
        'encuesta_respuestas' => $encuesta_respuestas,
    ]) ?>

</div>
