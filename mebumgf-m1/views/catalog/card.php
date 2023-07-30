<?php 
use yii\bootstrap5\Html;

?>

    <div class="card text-center mb-3" style="width: 18rem;">
    <?= Html::a(Html::img( $model->photo, ['alt' => $model->title, 'width' => 200, 'height' => 180]), ['view', 'id' => $model->id]) ?>
        <div class="card-body">
            <h5 class="card-title"><?= $model->title ?></h5>
            <h5 class="card-title"><?= $model->price ?> руб.</h5>
            <?php if (!Yii::$app->user->isGuest && !Yii::$app->user->identity->IsAdmin): ?>
                <?= Html::a('Добавить в корзину', [''], ['class' => 'btn btn-outline-secondary cart-add', 'data-product-id' => $model->id]) ?>
            <?php endif; ?>
        </div>
    </div>
