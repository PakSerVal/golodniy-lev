<?php

use yii\helpers\Html;

?>
<header class="header">
    <a href="/receipts" class="header__item link">Рецепты</a>
    <a href="/" class="header__logo link">
        <img src="/images/logo.jpg" alt="logo">
        <span>Голодный лев</span>
    </a>
    <div class="header__item header__item_media">
        <a href="https://www.instagram.com/golodnyilev"><?= Html::img('/images/icons/instagram.png') ?></a>
        <a href="https://www.youtube.com/channel/UC1eNb9DPsG4rgKBmREhIsWQ"><?= Html::img('/images/icons/youtube.png') ?></a>
        <a href="https://vk.com/golodnyilev"><?= Html::img('/images/icons/vk.png') ?></a>
    </div>
    </nav>
</header>
