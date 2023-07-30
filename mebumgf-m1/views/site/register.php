<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\widgets\Pjax;



$this->title = 'Регистрация';

?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

        <div class="row">
            <div class="col-lg-5">
              <!-- Pjax:: begin(['id'=>"associates-ajax-list",
                                "enablePushState"=>FALSE,
                                "enableReplaceState"=>FALSE,
                                "timeout"=> 5000,]); -->
                <?php $form = ActiveForm::begin(['id' =>'register-form','options'=>['data-pjax'=>true]]); ?>

                    <?= $form->field($model,'name',['enableAjaxValidation' => true])->textInput(['autofocus' => true]) ?>
                    <?= $form->field($model,'surname',['enableAjaxValidation' => true])->textInput(['autofocus' => true]) ?>
                    <?= $form->field($model,'patronymic')->textInput(['autofocus' => true]) ?>
                    <?= $form->field($model,'email',['enableAjaxValidation' => true]) ?>
                    <?= $form->field($model,'login',['enableAjaxValidation' => true]) ?>
                    <?= $form->field($model,'password',['enableAjaxValidation' => true]) ->passwordInput() ?>
                    <?= $form->field($model,'password_repeat',['enableAjaxValidation' => true])->passwordInput() ?>
                    <?= $form->field($model,'rules')->checkbox() ?>


                   

                    <div class="form-group">
                        <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary', 'name' =>'register-btn']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
                  <!-- Pjax:: end();  -->

                
            </div>
        </div>

</div>
