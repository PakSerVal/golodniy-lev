<?php

declare(strict_types=1);

namespace backend\assets\widgets;

use backend\assets\AppAsset;
use yii\web\AssetBundle;

/**
 * ReceiptsStepsInputWidget asset bundle
 *
 * @author Pak Sergey
 */
class ReceiptsStepsInputBundle extends AssetBundle {
    public $js = [
        '/js/receipts-steps-input.js'
    ];

    public $depends = [
        AppAsset::class,
    ];
}
