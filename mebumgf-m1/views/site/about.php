<?php

/** @var yii\web\View $this */

use yii\bootstrap5\Html;
use app\assets\AppAsset;
use yii\bootstrap5\Carousel;

// use yii\bootstrap5\Html;

$this->title = 'О нас';
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    

  <?php
    $items = [];
     foreach($products as $product) {
       $items[] = ['content' => "<img src='{$product [ 'photo']}' class='d-block text-center mx-auto' style='width:500px; height:500px;' alt=''>",
                  'caption' => "<h3 class='carousel-caption d-none d-md-block'>{$product['title']}</h3>"
                  ];
    }
  ?>
      <?= Carousel::widget ([
        'items' => $items,
        'options' => ['class' => 'carousel carousel-dark slide',
                    'data-bs-ride' => 'carousel', 
                    'data-bs-interval' => '5000',
                ],
            ]);
  ?>
</div>
    

    <div>
        <h3>Компания «Copy Star» занимается обслуживанием физических и юридических 
        лиц и дает возможность приобретать любой товар в любом количестве из всего 
        огромного ассортимента, представленного на сайте компании. Индивидуальный подход 
        к каждому клиенту и выделение персонального менеджера по продажам позволяет подобрать 
        наиболее эффективное решение и обеспечить достойный сервис, отвечающий всем пожеланиям.</h3>
      </div>


