<?php

/* @var $this View */
/* @var $content string */

use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\web\View;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title ?? 'Голодный лев. Рецепты, доступные каждому') ?></title>
    <?php $this->head() ?>

    <?php if (!YII_ENV_DEV): ?>
        <!-- Yandex.Metrika counter -->
        <script type="text/javascript" >
            (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
                m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
            (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

            ym(57248095, "init", {
                clickmap:true,
                trackLinks:true,
                accurateTrackBounce:true,
                webvisor:true,
                ecommerce:"dataLayer"
            });
        </script>
        <noscript><div><img src="https://mc.yandex.ru/watch/57248095" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <!-- /Yandex.Metrika counter -->
    <?php endif; ?>
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
