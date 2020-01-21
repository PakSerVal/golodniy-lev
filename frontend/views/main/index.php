<?php

use common\helpers\StringHelper;
use frontend\widgets\MainPageReceipts;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Main page.
 */
?>
<section class="carousel">
    <div class="carousel__receipts">
        <div class="carousel__receipts-wrapper">
            <div class="carousel__receipts-title">ПОЛНЫЙ СПИСОК РЕЦЕПТОВ</div>
            <a class="carousel__receipts-btn" href="<?= Url::toRoute(['/receipts']) ?>">ПЕРЕЙТИ</a>
        </div>
    </div>
</section>
<section>
    <?= MainPageReceipts::widget() ?>
</section>
<section class="media">
    <div class="media__title">СОЦИАЛЬНЫЕ СЕТИ</div>
    <div class="media__items">
        <div class="media__item media__item_instagram">
            <a href="https://www.instagram.com/golodnyilev"><?= Html::img('/images/icons/media-instagram.png', ['alt' => 'media-instagram']) ?></a>
            <div class="media__item-stat">
                <div>более</div>
                <div class="media__item-stat-count">1000</div>
                <div><?= StringHelper::countPostfix(1000, ['подписчик', 'подписчика', 'подписчиков'], false) ?></div>
            </div>
        </div>
        <div class="media__item media__item_youtube">
            <a href="https://www.youtube.com/channel/UC1eNb9DPsG4rgKBmREhIsWQ"><?= Html::img('/images/icons/media-youtube.png', ['alt' => 'media-youtube']) ?></a>
            <div class="media__item-stat">
                <div>более</div>
                <div class="media__item-stat-count">60000</div>
                <div><?= StringHelper::countPostfix(1000, ['просмотр', 'просмотра', 'просмотров'], false) ?></div>
            </div>
        </div>
    </div>
</section>
