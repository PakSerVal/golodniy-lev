<?php

use frontend\widgets\MainPageReceipts;

/**
 * Main page.
 */
?>
<section>
    <div class="about">
        <h2 class="about__title">Обо мне</h2>
        <p>Всем привет!!! Я Лев и я люблю готовить. Это мой личный сайт. Здесь вы найдёте все мои рецепты. Всю жизнь готовлю. Профессиональный повар с 30-летним стажем, блогер и просто крутой чувак</p>
    </div>
</section>
<section>
    <?= MainPageReceipts::widget() ?>
</section>
<!--<section>-->
<!--    <div class="generator-info">-->
<!--        <h2>Генератор блюд</h2>-->
<!--    </div>-->
<!--</section>-->
