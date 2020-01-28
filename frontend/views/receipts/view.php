<?php

use common\helpers\StringHelper;
use frontend\dto\Receipt;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/**
 * Receipts.
 *
 * @var Receipt $receipt
 * @var View    $this
 *
 * @author Pak Sergey
 */

$this->title = $receipt->title . '. Как приготовить' . $receipt->title . '. Авторские рецепты';
$this->registerMetaTag(['name' => 'description', 'content' => $receipt->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => implode(',', ArrayHelper::getColumn($receipt->tags, 'title'))])
?>

<div class="receipt-card">
    <h1 class="receipt-card__title"><?= $receipt->title ?></h1>
    <div class="receipt-card__description"><?= $receipt->description ?></div>
    <?php if (null !== $receipt->videoUrl && '' !== $receipt->videoUrl): ?>
        <div class="receipt-card__video">
            <iframe width="560" height="315" src="<?= $receipt->videoUrl ?>"></iframe>
        </div>
    <?php else: ?>
        <?php if (null !== $receipt->imageUrl): ?>
            <div class="receipt-card__image">
                <?= Html::img($receipt->imageUrl, ['alt' => $receipt->title]) ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <div class="receipt-card__content">
        <div class="receipt-card__ingredients">
            <h2 class="receipt-card__ingredients-title">Ингредиенты</h2>
            <?php foreach ($receipt->ingredients as $ingredient): ?>
                <div class="ingredient">
                    <?= ucfirst($ingredient->title) ?> - <?= ($ingredient->count !== '0') ? $ingredient->count : null ?> <?= $ingredient->measureUnit ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="receipt-card__instruction">
            <h2 class="receipt-card__instruction-title">Инструкция по приготовлению</h2>
            <div class="receipt-card__duration">
                Время приготовления: <?= StringHelper::countPostfix($receipt->duration, ['минута', 'минуты', 'минут']) ?>
            </div>
            <div class="receipt-card__portions-count">
                Количество порций: <?= $receipt->portionsCount ?> шт.
            </div>
            <?php foreach ($receipt->steps as $i => $step): ?>
                <div class="step">
                    <div class="step__wrapper">
                        <div class="step__number"><?= $i + 1 ?></div>
                        <div class="step__content"><?= $step->content ?></div>
                    </div>
                    <?php if (null !== $step->imageUrl): ?>
                        <div class="step__image">
                            <?= Html::img($step->imageUrl, ['alt' => $receipt->title]) ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="receipt-card__stats">
        <div class="receipt-card__date-views-wrapper">
            <div class="receipt-card__date"><i></i><?= $receipt->date->format('d-m-y') ?></div>
            <div class="receipt-card__views-count"><i></i><?= $receipt->viewsCount ?></div>
        </div>
        <div class="receipt-card__tags">
            <?php foreach ($receipt->tags as $i => $tag): ?>
                <?= Html::a($tag->title, Url::toRoute(['/receipts', 'tag' => $tag->id]), ['class' => 'link receipt-card__tag']) ?>
                <?php if(count($receipt->tags) - 1 !== $i): ?>
                    <div class="receipt-card__dot-wrapper">
                        <span class="receipt-card__dot"></span>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
