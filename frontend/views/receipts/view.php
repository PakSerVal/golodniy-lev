<?php

use frontend\dto\Receipt;
use yii\helpers\Html;

/**
 * Receipts.
 *
 * @var Receipt $receipt
 *
 * @author Pak Sergey
 */
?>

<div class="receipt-card">
    <div class="receipt-card__image" style="background-image: url('<?= $receipt->imageUrl ?>')"></div>
    <div class="receipt-card__tags">
        <?php foreach ($receipt->tags as $tag): ?>
            <?= Html::a($tag->title, $tag->url, ['class' => 'link link_tag']) ?>
        <?php endforeach; ?>
    </div>
    <h2 class="receipt-card__title">
        <?= $receipt->title ?>
    </h2>
    <div class="receipt-card__content">
        <?= $receipt->content ?>
    </div>
</div>
