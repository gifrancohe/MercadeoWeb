<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tendero */

$this->title = 'Crear Tendero';
$this->params['breadcrumbs'][] = ['label' => 'Tenderos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tendero-create">

    <h1><?= Html::encode($this->title);
    
    
    ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'municipios' => $municipios,
        'puntos' => $puntos,
        'usuarios' => $usuarios,
    ]) ?>

</div>
