<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class EditReceiptPage extends AssetBundle {
    public $js = [
        '/js/edit-receipt-page.js'
    ];

    public $depends = [
        AppAsset::class,
    ];
}
