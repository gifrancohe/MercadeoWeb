<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use app\models\Municipio;
use common\models\User;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Inicio', 'url' => ['/site/index']],
        /*['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],*/
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Registrarse', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Ingresar', 'url' => ['/site/login']];
    } else {
        if(Yii::$app->user->identity->tipo_usuario_id === 1) {
            $menuItems[] = ['label' => 'Tenderos', 'url' => ['/tendero/index']];
            $menuItems[] = ['label' => 'Clientes', 'url' => ['/cliente/index']];
            $menuItems[] = ['label' => 'Puntos de Venta', 'url' => ['/punto-venta/index']];
            $menuItems[] = ['label' => 'Productos', 'url' => ['/producto/index']];
            $menuItems[] = ['label' => 'Precios', 'url' => ['/precio/index']];
            $menuItems[] = ['label' => 'Presentaciones', 'url' => ['/presentacion/index']];
            $menuItems[] = ['label' => 'Estadisticas', 'url' => ['/venta/estadistica']];
            $menuItems[] = ['label' => 'Usuarios', 'url' => ['/user/index']];
            $menuItems[] = ['label' => 'BD', 'url' => ['/db/generar']];
        }
        if(Yii::$app->user->identity->tipo_usuario_id === 2) {
            $menuItems[] = ['label' => 'Encuesta', 'url' => ['/encuesta/encuesta']];
        }
        if(Yii::$app->user->identity->tipo_usuario_id === 3) {
            $menuItems[] = ['label' => 'Ventas', 'url' => ['/venta/index']];
            $menuItems[] = ['label' => 'Pedidos', 'url' => ['/pedido/index']];
            $menuItems[] = ['label' => 'Clientes', 'url' => ['/cliente/index']];
        }
        if(Yii::$app->user->identity->tipo_usuario_id === 4 || Yii::$app->user->identity->tipo_usuario_id === 5) {
            $menuItems[] = ['label' => 'Estadisticas', 'url' => ['/venta/estadistica']];
        }
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Salir  (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right">
            <?php if(Yii::$app->getRequest()->getCookies()->getValue('user_name')): ?>
                <b>Nombre</b>: <?= Yii::$app->getRequest()->getCookies()->getValue('user_name')?>
            <?php endif;?>
            <?php if(Yii::$app->getRequest()->getCookies()->getValue('ciudad')): ?>
                <b>Ciudad</b>: <?= Yii::$app->getRequest()->getCookies()->getValue('ciudad')?>
            <?php endif;?>
            <?php if(Yii::$app->getRequest()->getCookies()->getValue('date')): ?>
                <b>Fecha</b>: <?= Yii::$app->getRequest()->getCookies()->getValue('date')?>
            <?php endif;?>
            <?php if(Yii::$app->getRequest()->getCookies()->getValue('time')): ?>
                <b>Hora</b>: <?= Yii::$app->getRequest()->getCookies()->getValue('time')?>
            <?php endif;?>
        </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
