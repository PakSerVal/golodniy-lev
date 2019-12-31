<?php

use frontend\widgets\MainPageReceipts;

/**
 * Main page.
 */
?>
<section>
    <div class="about">
        <h2 class="about__title">Обо мне</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet iure minus nemo repellendus, repudiandae similique vel voluptates? A aliquam architecto deserunt dolor dolores laboriosam mollitia nemo quibusdam, repudiandae vel vitae.</p>
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
