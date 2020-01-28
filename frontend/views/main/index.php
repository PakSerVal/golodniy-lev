<?php

use common\helpers\StringHelper;
use common\models\Tag;
use frontend\assets\IdealImageSliderAsset;
use frontend\widgets\MainPageReceipts;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Main page.
 *
 * @var $youtubeViewsCount
 * @var $instagramSubsCount
 *
 * @author Pak Sergey
 */

IdealImageSliderAsset::register($this);

$this->registerMetaTag(['name' => 'description', 'content' => 'Первые блюда. Вторые блюда. Вкусные салаты. Закуски. Супы. Вегетарианские блюда. Праздничные и новогодние рецепты. Домашние рецепты. И многое другое...']);
$this->registerMetaTag(['name' => 'keywords', 'content' => 'Голодный лев, авторские рецепты'])
?>
<section id="slider">
    <img data-src="/images/slider-receipts.png" alt="" data-caption="#slider-receipts-caption">
    <img data-src="/images/slider-healthy-food.png" alt="" data-caption="#slider-healthy-food-caption">
    <img data-src="/images/slider-popular.png" alt="" data-caption="#slider-popular-caption">
</section>
<div style="display: none">
    <div id="slider-receipts-caption">
        <div class="caption">
            <h3 class="caption__title">ПОЛНЫЙ СПИСОК РЕЦЕПТОВ</h3>
            <a class="caption__button link" href="<?= Url::toRoute(['/receipts']) ?>">ПЕРЕЙТИ</a>
        </div>
    </div>
    <div id="slider-healthy-food-caption">
        <div class="caption">
            <h3 class="caption__title">ПРАВИЛЬНОЕ ПИТАНИЕ</h3>
            <a class="caption__button" href="<?= Url::toRoute(['/receipts', 'tag' => Tag::HEALTHY_FOOD_TAG_ID]) ?>">ПЕРЕЙТИ</a>
        </div>
    </div>
    <div id="slider-popular-caption">
        <div class="caption">
            <h3 class="caption__title">ПОПУЛЯРНЫЕ РЕЦЕПТЫ</h3>
            <a class="caption__button" href="<?= Url::toRoute(['/receipts/popular']) ?>">ПЕРЕЙТИ</a>
        </div>
    </div>
</div>

<section class="container">
    <h2 class="about-title">ОБО МНЕ</h2>
    <div class="about">
        <div class="about__image">
            <?= Html::img('/images/lev.jpg', ['alt' => 'lev']) ?>
        </div>
        <div class="about__text">
            Я - обычный парень, житель Дальнего Востока. Люблю не просто готовить, а экспериментировать, в результате чего порой получаются не совсем стандартные блюда. В последнее время активно занимаюсь спортом, из-за чего стараюсь выпускать рецепты правильного питания, которые использую сам в повседневной жизни.
            <p>На сайте представлены простые и вкусные рецепты, доступные каждому! Все блюда приготовлены лично и представлены в видео формате. Первые блюда. Вторые блюда.  Вкусные салаты. Закуски. Супы. Вегетарианские блюда. Праздничные и новогодние рецепты. Домашние рецепты. И многое другое...</p>
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
                <div class="media__item-stat-count"><?= $instagramSubsCount ?></div>
                <div><?= StringHelper::countPostfix($instagramSubsCount, ['подписчик', 'подписчика', 'подписчиков'], false) ?></div>
            </div>
        </div>
        <div class="media__item media__item_youtube">
            <a href="https://www.youtube.com/channel/UC1eNb9DPsG4rgKBmREhIsWQ"><?= Html::img('/images/icons/media-youtube.png', ['alt' => 'media-youtube']) ?></a>
            <div class="media__item-stat">
                <div>более</div>
                <div class="media__item-stat-count"><?= $youtubeViewsCount ?></div>
                <div><?= StringHelper::countPostfix($youtubeViewsCount, ['просмотр', 'просмотра', 'просмотров'], false) ?></div>
            </div>
        </div>
    </div>
</section>
