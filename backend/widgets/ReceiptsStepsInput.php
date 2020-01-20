<?php

namespace backend\widgets;

use backend\assets\widgets\ReceiptsStepsInputBundle;
use backend\models\ReceiptStepsForm;
use common\services\ImageService;
use yii\base\Widget;
use yii\bootstrap\Html;

/**
 * Receipts step input.
 *
 * @author Pak Sergey
 */
class ReceiptsStepsInput extends Widget {

    /** @var ImageService */
    private $imageService;

    /**
     * @param ImageService $service
     * @param array $config
     *
     * @author Pak Sergey
     */
    public function __construct(ImageService $service, $config = []) {
        $this->imageService = $service;

        parent::__construct($config);
    }

    /**
     * @inheritDoc
     *
     * @author Pak Sergey
     */
    public function init() {
        $this->view->registerAssetBundle(ReceiptsStepsInputBundle::class);

        parent::init();
    }

    /**
     * @inheritDoc
     *
     * @author Pak Sergey
     */
    public function run() {
        $result = '';

        $result .= '
            <div class="steps-input-wrapper">
                <div class="form-group input-element" data-role="step-template" hidden>
                    <textarea name="' . ReceiptStepsForm::ATTR_STEP_CONTENTS . '[]" class="form-control"></textarea>
                    <br>
                    <div style="display: flex; justify-content: space-between;">
                        ' . Html::fileInput(ReceiptStepsForm::ATTR_STEP_IMAGES . '[]', null) . '
                        <div class="btn btn-danger" data-role ="remove-step-btn">Удалить шаг</div>
                    </div>
                </div>
            </div>
        ';

        $result .= '<div class="btn btn-success" data-role ="add-step-btn">Добавить шаг</div><br>';

        return $result;
    }
}
