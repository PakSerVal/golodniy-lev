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
class ReceiptIngredientsInputBundle extends AssetBundle {
    public $js = [
        '/js/receipt-ingredients-input.js'
    ];

    public $depends = [
        AppAsset::class,
    ];
}
