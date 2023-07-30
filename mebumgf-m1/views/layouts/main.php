<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\Modal;
use yii\widgets\Pjax;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => '@web/favicon.ico']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => 'Copy Star',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label'=> 'Где нас найти?', 'url' => ['/site/location']],
            // ['label' => 'Главная', 'url' => ['/site/index']],
            ['label' => 'О нас', 'url' => ['/site/about']],
            !Yii::$app->user->isGuest && Yii::$app->user->identity->IsAdmin ? ['label' => 'Панель управления', 'url'=>['/admin']] : '',
            !(Yii::$app->user->isGuest || Yii::$app->user->identity->IsAdmin) ? ['label' => 'Личный кабинет', 'url'=>['/account']] : '',
            Yii::$app->user->isGuest ? ['label' => 'Регистрация', 'url' => ['/site/register']]: '',
            // ['label' => 'Контакты', 'url' => ['/site/contact']],
            ['label' => 'Каталог', 'url' => ['/catalog']],
            
            // !Yii::$app->user->isGuest && Yii::$app->user->identity->IsAdmin ? 
            // ['label' => 'Посты', 'url' => ['/admin-post']] : '',

            Yii::$app->user->isGuest
                ? ['label' => 'Вход', 'url' => ['/site/login']]
                : '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Выход (' . Yii::$app->user->identity->login . ')',
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
        ]
    ]);

    if (!(Yii::$app->user->isGuest || Yii::$app->user->identity->IsAdmin)):
        ?>
            <div class="flex-grow-1">
                <div id='cart-link' class="float-right text-light">Корзина</div>
            </div>
    <?php
        endif;

    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">

        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; Copy Star <?= date('Y') ?></div>
        </div>
    </div>
</footer>
<?php 
    if(!(Yii::$app->user->isGuest ||  Yii::$app->user->identity->IsAdmin)):
        Modal::begin([
                    'title' => 'Корзина',
                    'options' => ['id' => 'cart', 'class' => 'footer-model'],
                    'size' => 'modal-xl',
                    'bodyOptions' => ['id' => 'body-cart'],
                    'footer' => '
                    <div><a href="/cart/view?btn=trash&id=1" class="btn btn-danger disabled m-1" id="clear">Очистить корзину</a></div>
                    <div><a href="/catalog" class="btn btn-primary m-1" data-dismiss="modal">Продолжить покупки</a></div>
                    <div><a href="/account/create" class="btn btn-success disabled m-1" id="order">Оформить заказ</a></div>',
                ]);
                Pjax::begin(['id' => 'cart-pjax', 'enablePushState' => false, 'enableReplaceState' => false, 'timeout' => 5000]);

                Pjax::end();
        Modal::end();
        Modal::begin([
            'title' => 'Информация',
            'headerOptions' => ['class' => 'text-light bg-primary'],
            'options' => ['id' => 'modal-error'],
        ]);
            echo "<p>Добавлено доступное количество товара.</p>";
        Modal::end();
        
        
        $this->registerJsFile('/js/cart.js',
            [
                'depends' => ['yii\web\YiiAsset', 'yii\bootstrap5\BootstrapAsset'],
                'position' => yii\web\View::POS_END
            ]
        );
    endif;

?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
