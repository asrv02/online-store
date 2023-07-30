<?php

use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Order $model */

$this->title = 'Оформление заказа';
?>
<div class="order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('../cart/view.php', ['cart' => $cart, 'dataProvider' => $dataProvider, 'btn_no' => true, 'url' => $url, 'res' => true, 'status' => $status,]) ?>

    <div class="mt-3" id="agree">
        <?php $form = ActiveForm::begin([
            'id' => 'confirm-form',
            'enableAjaxValidation' => true,
        ]); ?>

    <div class='offset-7 col-5 align-items-start justify-content-end'>
        <?= $form->field($login, 'password')->passwordInput(['placeholder' => "Введите ваш пароль", 'id' => 'psw'])->label('Для подтверждения заказа введите свой пароль') ?>
        <?= Html::submitButton('Сформировать заказ', ['class' => 'btn btn-primary flex-fill', 'name' => 'confirm-button', 'id' => 'agree']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    </div>
</div>
