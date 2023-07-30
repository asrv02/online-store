<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\CatalogSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="row">
    <div class="col-md-6">
        <div>Сортировка по:</div>
        <div class="row sort">
            <div class="sort-item first-item"><?= $dataProvider->sort->link('title') ?> </div>
            <div class="sort-item"><?= $dataProvider->sort->link('price') ?> </div>
            <div class="sort-item last-item"><?= $dataProvider->sort->link('year') ?> </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="product-search">

            <?php $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
                'options' => [
                    'data-pjax' => 1
                ],
            ]); ?>
            <?php 
                $params = [
                    'prompt' => 'Все категории'
                ];
                echo $form->field($model, 'category_id')->dropDownList($category, $params)->label('Выберите категорию');
                ?>
                <div>
                <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
        <div class="row">
            <div class="col">
            <?= Html::a('Сбросить', ['/catalog'], ['class' => 'btn btn-outline-secondary mb-3']) ?>
            </div>
        </div>

