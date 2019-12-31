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

<div class="receipts-list">
    <?php foreach ($receipts as $receipt): ?>
        <div class="receipt">
            <a href="<?= Url::toRoute(['receipts/view', 'id' => $receipt->id]) ?>" class="receipt__image">
                <?= Html::img($receipt->imageUrl) ?>
            </a>
            <div class="receipt__wrapper">
                <div class="receipt__tags">
                    <?php foreach ($receipt->tags as $tag): ?>
                        <?= Html::a($tag->title, $tag->url, ['class' => 'link link_tag']) ?>
                    <?php endforeach; ?>
                </div>
                <div class="receipt__title">
                    <?= Html::a($receipt->title, Url::toRoute(['receipts/view', 'id' => $receipt->id]), ['class' => 'link']) ?>
                </div>
                <div class="receipt__stats">
                    <div class="receipt__ingredients">
                        <div class="receipt__ingredients-icon">
                            <?= Html::img('/images/icons/ingredients.svg') ?>
                        </div>
                        <div class="receipt__ingredients-text">
                            <?= StringHelper::countPostfix($receipt->ingredientsCount, ['Ингридиент', 'Ингридиента', 'Ингридиентов']) ?>
                        </div>
                    </div>
                    <div class="receipt__duration">
                        <div class="receipt__duration-icon">
                            <?= Html::img('/images/icons/clock.svg') ?>
                        </div>
                        <div class="receipt__duration-text">
                            <?= StringHelper::countPostfix($receipt->duration, ['минута', 'минуты', 'минут']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
