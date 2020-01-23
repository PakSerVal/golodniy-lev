<?php

use common\helpers\StringHelper;
use frontend\dto\Receipt;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Main page widget view.
 *
 * @var Receipt[] $receipts
 *
 * @author Pak Sergey
 */
?>
<div class="main-page-receipts-title">
    <?= Html::img('/images/icons/spoon.png', ['alt' => 'spoon']) ?>
</div>
<div class="container main-page-receipts">
    <?php foreach ($receipts as $receipt): ?>
        <div class="main-page-receipt">
            <div class="main-page-receipt__wrapper">
                <a href="<?= Url::toRoute(['receipts/view', 'id' => $receipt->id]) ?>">
                    <div class="main-page-receipt__image">
                        <?= Html::img($receipt->imageUrl, ['alt' => $receipt->title]) ?>
                    </div>
                </a>
                <a href="<?= Url::toRoute(['receipts/view', 'id' => $receipt->id]) ?>">
                    <div class="main-page-receipt__title link">
                        <?= $receipt->title ?>
                    </div>
                </a>
                <div class="main-page-receipt__description">
                    <?= StringHelper::truncate($receipt->description, 110) ?>
                </div>
                <div class="main-page-receipt__stats">
                    <div class="main-page-receipt__date"><i></i><?= $receipt->date->format('d.m.y') ?></div>
                    <div class="main-page-receipt__views-count"><i></i>0</div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="main-page-receipts__button">
        <?= Html::a('Все рецепты', 'receipts', ['class' => 'animated-link']) ?>
    </div>
</div>
