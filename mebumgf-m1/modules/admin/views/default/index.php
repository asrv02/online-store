<?php

use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Order;
use Codeception\Attribute\DataProvider;
use yii\bootstrap5\Modal;
use yii\bootstrap5\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Управление заказами';

?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Управление категориями', ['/category'], ['class' => 'btn btn-success']) ?>

        <?= Html::a('Управление товарами', ['/product'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'user_id',
                'value' => function($model){
                    return $model->user->name . ' ' . $model->user->surname . ' ' . $model->user->patronymic;
                },              
                'label' => 'ФИО заказчика',
                'filter' => false,
            ],
            [
                'attribute' => 'time',
                'value' => function($model){
                    return date('d.m.Y H:i:s', Yii::$app->formatter->asTimestamp($model->time));
                },
                'filter' => false,
            ],
            [
                'attribute' => 'count',
                'filter' => false,
            ],
            // 'sum',
            
            [
                'attribute' => 'status_id',
                'value' => function($model){
                    return $model->status->title;
                },              
                'label' => 'Статус заказов',
                'filter' => $status,
            ],
            [
                'label' => 'Действие',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::a('<svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:1.125em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M573 241C518 136 411 64 288 64S58 136 3 241a32 32 0 000 30c55 105 162 177 285 177s230-72 285-177a32 32 0 000-30zM288 400a144 144 0 11144-144 144 144 0 01-144 144zm0-240a95 95 0 00-25 4 48 48 0 01-67 67 96 96 0 1092-71z"/></svg> Просмотреть заказ',['view', 'id' => $model->id],['class' => 'btn btn-outline-primary m-2'])
                    . (
                    $model->status->title == 'Новый' ? Html::a('<svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:1em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M498 142l-46 46c-5 5-13 5-17 0L324 77c-5-5-5-12 0-17l46-46c19-19 49-19 68 0l60 60c19 19 19 49 0 68zm-214-42L22 362 0 484c-3 16 12 30 28 28l122-22 262-262c5-5 5-13 0-17L301 100c-4-5-12-5-17 0zM124 340c-5-6-5-14 0-20l154-154c6-5 14-5 20 0s5 14 0 20L144 340c-6 5-14 5-20 0zm-36 84h48v36l-64 12-32-31 12-65h36v48z"/></svg> Подтвердить заказ', ['apply-order', 'id' => $model->id],['class' => 'btn btn-outline-success m-2'])
                    . 
                    Html::a('<svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:1em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M498 142l-46 46c-5 5-13 5-17 0L324 77c-5-5-5-12 0-17l46-46c19-19 49-19 68 0l60 60c19 19 19 49 0 68zm-214-42L22 362 0 484c-3 16 12 30 28 28l122-22 262-262c5-5 5-13 0-17L301 100c-4-5-12-5-17 0zM124 340c-5-6-5-14 0-20l154-154c6-5 14-5 20 0s5 14 0 20L144 340c-6 5-14 5-20 0zm-36 84h48v36l-64 12-32-31 12-65h36v48z"/></svg> Отменить заказ', ['index', 'id' => $model->id],['class' => 'btn btn-outline-secondary m-2']) 
                    : '');
                    
                }
            ]


            // 'reason',
            // [
            //     'class' => ActionColumn::class,
            //     'template' => '{view} {update} {delete}',
            //     'visibleButtons' => [
            //         'update' => function ($model) {
            //             return $model->status->id == 1;
            //          },
            //          'delete' => function ($model) {
            //             return $model->status->id == 1;
            //          }
            //         ],
            //     'urlCreator' => function ($action, Order $model, $key, $index, $column) {
            //         return Url::toRoute([$action, 'id' => $model->id]);
            //      }
            // ],
        ],
    ]); ?>
    
    <?php
    if( \Yii::$app->session->hasFlash('check1') ){
        Modal::begin([
            'title' => 'Информация',
            'headerOptions' => ['class' => 'text-light bg-primary'],
            'options' => ['id' => 'modal-apply'],
        ]);
            echo "<p>Заказ подтверждён.</p>";
        Modal::end();
        

        $this->registerJs("$(document).ready(()=>$(\"#modal-apply\").modal('show'))"        );
    }
    
    ?>
    <?php
    if( $dataProvider->totalCount > 0 && !empty($model)){
        Modal::begin([
            'title' => 'Отмена заказа',
            'headerOptions' => ['class' => 'text-light bg-primary'],
            'options' => ['id' => 'modal-cancel'],
            'size' => 'modal-xl',

        ]); ?>
        <div class="order-form">

        <?php $form = ActiveForm::begin(); ?>
    
    
        <?= $form->field($model, 'reason')->textInput(['maxlength' => true]) ?>
        
    
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>
    
        <?php ActiveForm::end(); ?>
    
    </div>
    <?php
        Modal::end();
        

        $this->registerJs("$(document).ready(()=>$(\"#modal-cancel\").modal('show'))"        );
    }
    
    ?>

    <?php Pjax::end(); ?>

</div>