<?php

/** @var yii\web\View $this */

use yii\bootstrap5\Html;

$this->title = 'Где нас найти?';
?>
<div class="site-about">
    <p><img style = 'height : 100%; width: 65vh; ' src='/img/123.png'></p>
    <h1><?= Html::encode($this->title) ?></h1>
    <div>
    <h4><b>Номер телефона:</b> 8(900)123-45-67 </h4>
    <h4><b>Адрес:</b> г. Санкт-Петербург, ул. Малая морская, д. 98 лит К </h4>
    <h4><b>Email:</b> printer@lucshe.net</h4>
    </div>
</div>
