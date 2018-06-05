<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'nombre',
            'apellido',
            'cedula',
            'email:email',
            'direccion',
            'telefono',
            'municipio.municipio',
            'tipoUsuario.tipo_usuario',
            [
                'attribute' => 'status',
                'value' => (($model->status ==0) ? "Inactivo": (($model->status ==10)? "Activo" : $model->status)),
            ],
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            //'created_at',
            //'updated_at',
        ],
    ]) ?>

</div>
