<?php

use app\models\Product;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\bootstrap5\Card;
/** @var yii\web\View $this */
/** @var app\models\CatalogSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Каталог';
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?php Pjax::begin(['id'=>"pjax-catalog",
                                "enablePushState"=>FALSE,
                                "timeout"=> 5000]); ?>
    <?php echo $this->render('_search', ['model' => $searchModel, 'dataProvider' => $dataProvider, 'category' => $category]); ?>



    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'layout' => '{pager}<div class="row row-cols-4">{items}</div>{pager}',
        'pager' => ['class' => \yii\bootstrap5\LinkPager::class],
        'itemView' => 'card',
        
    ]) ?>

    <?php Pjax::end(); ?>

</div>
