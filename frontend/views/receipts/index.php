<?php

use common\helpers\StringHelper;
use frontend\dto\Receipt;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Receipts.
 *
 * @var Receipt[] $receipts
 *
 * @author Pak Sergey
 */
?>

<div class="container receipts-list">
    <h1 class="receipts-list__title">Рецепты</h1>
    <?php foreach ($receipts as $receipt): ?>
        <?php $receiptUrl = Url::toRoute(['receipts/view', 'id' => $receipt->id]) ?>
        <div class="receipt">
            <div class="receipt__image">
                <a href="<?= $receiptUrl ?>"><?= Html::img($receipt->imageUrl) ?></a>
            </div>
            <div class="receipt__title">
                <?= Html::a($receipt->title, $receiptUrl, ['class' => 'link']) ?>
            </div>
            <div class="receipt__description">
                <?= StringHelper::truncate($receipt->description, 140) ?>
            </div>
            <div class="receipt__tags">
                <?php foreach ($receipt->tags as $i => $tag): ?>
                    <?= Html::a($tag->title, '', ['class' => 'link receipt__tag']) ?>
                    <?php if(count($receipt->tags) - 1 !== $i): ?>
                        <div class="receipt__dot-wrapper">
                            <span class="receipt__dot"></span>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <a href="<?= $receiptUrl ?>"><button class="receipt__button">Посмотреть рецепт</button></a>
        </div>
    <?php endforeach; ?>
</div>
