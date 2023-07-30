<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Order $model */

$this->title = $model->title;

\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?=  $model->status->title == 'Новый' ? Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',           
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) :'' ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            // 'title',
            // 'user_id',
            
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
