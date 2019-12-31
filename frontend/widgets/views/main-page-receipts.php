<?php

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
<div class="main-page-receipts">
    <?php foreach ($receipts as $receipt): ?>
        <div class="main-page-receipt">
            <div class="main-page-receipt__image" style="background-image: url('<?= $receipt->imageUrl ?>')">
                <a href="<?= Url::toRoute(['receipts/view', 'id' => $receipt->id]) ?>" class="main-page-receipt__title">
                    <p><?= $receipt->title ?></p>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="main-page-receipts__button">
        <?= Html::a('Ещё рецепты', 'receipts', ['class' => 'animated-link']) ?>
    </div>
</div>
