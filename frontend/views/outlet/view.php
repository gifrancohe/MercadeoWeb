<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Outlet */

$this->title = $model->id_outlet;
$this->params['breadcrumbs'][] = ['label' => 'Outlets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outlet-view">

    <h1><?= Html::encode($this->title) ?></h1>

    
    <p>
        <?php if($user_type == 1):?>
            <?= Html::a('Actualizar', ['update', 'id' => $model->id_outlet], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Eliminar', ['delete', 'id' => $model->id_outlet], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Estas seguro que quieres eliminar este registro?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif;?>
    </p>
    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id_outlet',
            [
                'attribute' => 'Producto',
                'value' => $model->producto->nombre,
            ],
            'municipio.municipio',
            [
                'attribute' => 'Estado',
                'value' => $model->estado == 1 ? 'Activo': 'Inactivo',
            ],
            'create_at',
            'update_at',
        ],
    ]) ?>

</div>
