<?php

use common\helpers\StringHelper;
use frontend\dto\Receipt;
use yii\data\Pagination;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/**
 * Receipts.
 *
 * @var Receipt[]   $receipts
 * @var Pagination  $pages
 * @var string|null $tagTitle
 *
 * @author Pak Sergey
 */

$this->title = 'Рецепты';
$this->registerMetaTag(['name' => 'description', 'content' => 'Готовлю простые, вкусные и быстрые блюда по рецептам, доступным каждому.']);
$this->registerMetaTag(['name' => 'keywords', 'content' => 'Голодный лев, личный сайт, рецепты'])
?>

<div class="container receipts-list">
    <?php if (count($receipts) !== 0): ?>
        <h1 class="receipts-list__title">Рецепты <span><?= null !== $tagTitle ? '(' . $tagTitle . ')' : null ?></span></h1>
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
            </div>
        <?php endforeach; ?>
        <div class="receipts-list__pagination">
            <?= LinkPager::widget(['pagination' => $pages]) ?>
        </div>
    <?php else: ?>
        <div class="receipts-list__empty-result">
            <h2>К сожалению по запросу "<?= $tagTitle ?>" ничего не найдено</h2>
            <?= Html::img('/images/error.png', ['alt' => 'error']) ?>
        </div>
    <?php endif; ?>
</div>
