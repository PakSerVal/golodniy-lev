<?php

namespace common\helpers;

class Html extends \yii\helpers\Html {

    /**
     * @param string $src
     * @param array  $options
     *
     * @return string
     *
     * @author Pak Sergey
     */
    public static function lazyImg(string $src, array $options = []): string {
        $options = array_merge($options, [
            'data-src'      => $src,
            'data-lazy-img' => '',
        ]);

        return Html::img(null, $options);
    }
}
