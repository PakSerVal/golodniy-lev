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
class ReceiptsTagsInputBundle extends AssetBundle {
    public $js = [
        '/js/receipt-tags-input.js'
    ];

    public $depends = [
        AppAsset::class,
    ];
}
