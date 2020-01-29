<?php

use yii\helpers\Html;

?>
<header class="header">
    <div class="header__wrapper">
        <a href="/" class="header__logo">
            <?= Html::img('/images/logo.png', ['alt' => 'logo']) ?>
            <span>ГОЛОДНЫЙ ЛЕВ</span>
        </a>
        <div class="header__search">
            <form method="get" action="/search" class="search-form">
                <div class="presearch-input-wrapper">
                    <input id="presearch-input" type="text" name="q" autocomplete="off" data-presearch-url="/presearch" class="search-form__input" placeholder="Поиск рецептов...">
                    <i data-search-icon><?= Html::img('/images/icons/search.png', ['alt' => 'search']) ?></i>
                </div>
                <div class="presearch" data-search-wrapper></div>
            </form>
            <div class="header__media">
                <a href="https://www.instagram.com/golodnyilev"><?= Html::img('/images/icons/instagram.png') ?><span>Инстаграм</span></a>
                <a href="https://www.youtube.com/channel/UC1eNb9DPsG4rgKBmREhIsWQ"><?= Html::img('/images/icons/youtube.png') ?><span>Youtube</span></a>
                <a class="vk" href="https://vk.com/golodnyilev"><?= Html::img('/images/icons/vk.png') ?><span>Вконтакте</span></a>
            </div>
        </div>
    </div>
</header>
