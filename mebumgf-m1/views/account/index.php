<?php

use app\models\Order;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;
use yii\bootstrap5\Modal;

/** @var yii\web\View $this */
/** @var app\models\AccountSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Личный кабинет';
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>


     <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'filter' => false,
            ],
            [
                'attribute' => 'count',
                'filter' => false,
            ],
            // 'sum',
            [
                'attribute' => 'time',
                'value' => function($model){
                    return date('d.m.Y H:i:s', Yii::$app->formatter->asTimestamp($model->time));
                },
                'filter' => false,
            ],
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
                    $model->status->title == 'Новый' ? Html::a('<svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:.875em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M32 464a48 48 0 0048 48h288a48 48 0 0048-48V128H32zm272-256a16 16 0 0132 0v224a16 16 0 01-32 0zm-96 0a16 16 0 0132 0v224a16 16 0 01-32 0zm-96 0a16 16 0 0132 0v224a16 16 0 01-32 0zM432 32H312l-9-19a24 24 0 00-22-13H167a24 24 0 00-22 13l-9 19H16A16 16 0 000 48v32a16 16 0 0016 16h416a16 16 0 0016-16V48a16 16 0 00-16-16z"/></svg> Удалить заказ', ['delete', 'id' => $model->id],['class' => 'btn btn-outline-danger m-2', 'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ], ]) 
                    : '');
                    
                }
            ]
            // 'reason',
            // [
            //     'class' => ActionColumn::class,
            //     'template' => '{view} {delete}',
            //     'visibleButtons' => [
            //         'delete' => function ($model) {
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
    if( \Yii::$app->session->hasFlash('check2') ){
        Modal::begin([
            'title' => 'Информация',
            'headerOptions' => ['class' => 'text-light bg-primary'],
            'options' => ['id' => 'modal-cancel'],
            'size' => 'modal-xl',

        ]);
            echo "<p>Заказ удалён.</p>";
        Modal::end();
        

        $this->registerJs("$(document).ready(()=>$(\"#modal-cancel\").modal('show'))"        );
    }
    
    ?>

</div>
