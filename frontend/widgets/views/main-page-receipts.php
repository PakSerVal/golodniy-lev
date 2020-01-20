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
<h2 class="main-page-receipts-title">Мои рецепты</h2>
<div class="container main-page-receipts">
    <?php foreach ($receipts as $receipt): ?>
        <div class="main-page-receipt">
            <div class="main-page-receipt__wrapper">
                <a href="<?= Url::toRoute(['receipts/view', 'id' => $receipt->id]) ?>">
                    <div class="main-page-receipt__image">
                        <?= Html::img($receipt->imageUrl, ['alt' => $receipt->title]) ?>
                    </div>
                    <div class="main-page-receipt__title">
                        <?= $receipt->title ?>
                    </div>
                    <div class="main-page-receipt__description">
                        <?= StringHelper::truncate($receipt->description, 180) ?>
                    </div>
                    <div class="main-page-receipt__button-wrapper">
                        <button class="main-page-receipt__button">Посмотреть рецепт</button>
                    </div>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="main-page-receipts__button">
        <?= Html::a('Все рецепты', 'receipts', ['class' => 'animated-link']) ?>
    </div>
</div>
