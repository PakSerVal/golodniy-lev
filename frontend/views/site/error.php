<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">
    <h2><?= $message ?></h2>
    <?= Html::img('/images/error.png', ['alt' => 'error']) ?>
</div>
