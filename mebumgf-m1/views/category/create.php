<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var app\models\Category $model */

$this->title = 'Создать категорию';

?>
<div class="category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
