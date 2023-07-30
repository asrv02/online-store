<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var app\models\Product $model */

$this->title = 'Создать товар';

?>
<div class="product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'category' => $category,
    ]) ?>

</div>
