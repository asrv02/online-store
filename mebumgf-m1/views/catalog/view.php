<?php

use yii\bootstrap5\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Product $model */

$this->title = $model->title;

\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (!Yii::$app->user->isGuest && !Yii::$app->user->identity->IsAdmin): ?>
                <?= Html::a('Добавить в корзину', [''], ['class' => 'btn btn-outline-secondary cart-add', 'data-product-id' => $model->id]) ?>
            <?php endif; ?>
        <?= Html::a('Каталог', ['/catalog'], ['class' => 'btn btn-success']) ?> 
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'year',
            'price',
            'count',
            'country',
            'model',
            [
                'attribute' => 'photo',
                'format' => 'image',
            ],
            [
                'attribute'=>'category_id',
                'value'=>$model->category->title,
            ],
        ],
    ]) ?>

</div>
