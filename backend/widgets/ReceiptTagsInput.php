<?php

namespace backend\widgets;

use backend\assets\widgets\ReceiptsTagsInputBundle;
use backend\models\ReceiptTagsForm;
use yii\base\Widget;
use yii\helpers\Url;

/**
 * Виджет инпута тэгов рецепта.
 *
 * @author Pak Sergey
 */
class ReceiptTagsInput extends Widget {

    /**
     * @inheritDoc
     *
     * @author Pak Sergey
     */
    public function init() {
        $this->view->registerAssetBundle(ReceiptsTagsInputBundle::class);

        parent::init();
    }
    /**
     * @inheritDoc
     *
     * @author Pak Sergey
     */
    public function run() {
        $searchTagUrl = Url::toRoute(['/tags/presearch']);

        $result = '<div class="form-inline form-group">
            <input class="form-control add-tag-input" class="form-control" type="text" data-role="add-tag-input" data-url="' . $searchTagUrl . '">
            <div class="btn btn-success" data-role="add-tag-btn">Добавить тэг</div>
            <input type="hidden" data-role="tag-input-template" name="' . ReceiptTagsForm::ATTR_TAGS . '[]' . '">
            <div class="suggests-wrapper"><div class="suggests hidden" data-role="suggests"></div></div>
            <div class="input-wrapper"></div>
        </div>
        ';

        $result .= '<style>
            .add-tag-input {
                width: 200px
            }
            
            .suggests-wrapper {
                position: relative;
            }
            
            .suggests {
                position: absolute;
                border: 1px solid black;
                width: 200px;
            }

            .suggest {
                cursor: pointer;
                background-color: white;
                padding: 0 10px 10px;
            }
            
            .tag {
                padding: 3px;
                margin: 3px;
                display: inline-block;
                border: 1px solid black;
                border-radius: 4px;
                cursor: pointer;
            }
            
            .input-wrapper {
                display: flex;
            }
        </style>';

        return $result;
    }
}
