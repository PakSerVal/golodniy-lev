<?php

/* @var $this View */
/* @var $content string */

use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\web\View;

AppAsset::register($this);

$this->registerMetaTag(['description' => 'Всем привет!!! Я Лев и я люблю готовить. Это мой личный сайт. Здесь вы найдёте все мои рецепты. Всю жизнь готовлю. Профессиональный повар с 30 - летним стажем, блогер и просто крутой чувак']);
$this->registerMetaTag(['Keywords' => 'Голодный лев, личный сайт, рецепты'])
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title ?? 'Голодный лев') ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?= $this->render('//layouts/blocks/header') ?>

<main><?= $content ?></main>

<?= $this->render('//layouts/blocks/footer') ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
