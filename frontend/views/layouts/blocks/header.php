<?php

use yii\helpers\Html;

?>
<header class="header">
    <a href="/" class="header__logo link"><img src="/images/logo.png" alt="logo"></a>
    <div class="header__title">Приготовить может каждый, но готовить вкусно - это дар.</div>
    <div class="header__item header__item_media">
        <div class="media-links">
            <a href="https://www.instagram.com/golodnyilev"><?= Html::img('/images/icons/instagram.png') ?></a>
            <a href="https://www.youtube.com/channel/UC1eNb9DPsG4rgKBmREhIsWQ"><?= Html::img('/images/icons/youtube.png') ?></a>
            <a href="https://vk.com/golodnyilev"><?= Html::img('/images/icons/vk.png') ?></a>
        </div>
        <form method="get" action="/search" class="search-form">
            <div class="presearch-input-wrapper">
                <input id="presearch-input" type="text" name="q" autocomplete="off" data-presearch-url="/presearch" class="search-form__input" placeholder="Поиск по сайту...">
                <i data-search-icon><?= Html::img('/images/icons/search.png', ['alt' => 'search']) ?></i>
            </div>
            <div class="presearch" data-search-wrapper></div>
        </form>
    </div>
</header>
