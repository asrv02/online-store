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
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
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
                /*'value' => "<photo src='" .Yii::getAlias('@web') . '/img/' . $model->photo . "'> */
            ],
            [
                'attribute'=>'category_id',
                'value'=>$model->category->title,
            ],
        ],
    ]) ?>
 
</div>
