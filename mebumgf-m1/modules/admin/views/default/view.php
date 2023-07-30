<?php

use yii\bootstrap5\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = $model->id;

\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <h1><?= Html::encode($model->user->name . ' ' . $model->user->surname . ' ' . $model->user->patronymic) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            // 'title',
            // 'user_id',
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
                'attribute' => 'status_id',
                'value' => function($model){
                    return $model->status->title;
                },              
                'label' => 'Статус заказов',
            ],
            'count',
            [
                'attribute' => 'order_id',
                'format' => 'html',
                'value' => function ($model) {
                    $order_item = '';
                    foreach($model->orderItems as $value)
                    {
                        $order_item .= 
                        '<div> 
                        <table class="table">
                        <tbody>
                          <tr class="row">
                            <td class="col-5"> '.  $value -> title .'</td>
                            <td class="col"> '.  $value -> price .'</td>
                            <td class="col"> '.  $value -> count .'</td>
                            <td class="col"><img style ="width:100px;" src="'.  $value -> product -> photo .'"></td>
                          </tr>
                          </tbody>
                        </table>
                        </div>';

                    }
                    return $order_item;
                },
                'label' => 'Наименование товаров',
                'filter' => false,
            ],
        ],
    ]) ?>

</div>
