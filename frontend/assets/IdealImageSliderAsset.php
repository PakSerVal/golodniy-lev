<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class IdealImageSliderAsset extends AssetBundle {
    public $css = [
        'css/ideal-image-slider.css',
    ];

    public $js = [
        'js/ideal-image-slider.min.js',
        'js/iis-captions.js',
    ];
}
