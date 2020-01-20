<?php

namespace common\widgets;

use common\services\ImageService;
use yii\bootstrap\Html;
use yii\widgets\InputWidget;

/**
 * Image input.
 */
class ImageInput extends InputWidget {

    /** @var ImageService */
    private $service;

    /**
     * @inheritDoc
     *
     * @author Pak Sergey
     */
    public function __construct(ImageService $service, $config = []) {
        $this->service = $service;

        parent::__construct($config);
    }

    /**
     * @inheritDoc
     *
     * @author Pak Sergey
     */
    public function run() {
        $imageUrl = null;

        if (null !== $this->model->{$this->attribute}) {
            $imageUrl = $this->service->getImageUrl($this->model->{$this->attribute});
        }

        $html = '';

        if (null !== $imageUrl) {
            $html .= '<br><br><a href="' . $imageUrl . '" target="_blank">' . Html::img($imageUrl, ['style' => 'display: inline-block; max-height: 150px']) . '</a>';
        }
        $html .='<br><div class="file-input btn btn-default banner-image-input-wrapper">Выберите файл'
            . Html::activeFileInput($this->model, $this->attribute, [
                    'class'         => 'banner-image-input',
                    'hiddenOptions' => ['value' => $this->model->{$this->attribute}]
                ])
            .'</div>'
        ;

        return $html;
    }
}
