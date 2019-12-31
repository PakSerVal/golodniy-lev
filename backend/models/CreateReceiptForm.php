<?php

declare(strict_types=1);

namespace backend\models;

use common\helpers\validators\ImageUploadValidator;
use common\models\Receipt;
use yii\base\Model;
use yii\validators\RequiredValidator;
use yii\validators\StringValidator;
use yii\web\UploadedFile;

/**
 *
 */
class CreateReceiptForm extends Model {

    /** @var string */
    public $title;

    const ATTR_TITLE = 'title';

    /** @var string */
    public $content;

    const ATTR_CONTENT = 'content';

    /** @var UploadedFile */
    public $image;

    const ATTR_IMAGE = 'image';

    /**
     * @inheritDoc
     *
     * @author Pak Sergey
     */
    public function rules() {
        return [
            [static::ATTR_TITLE, RequiredValidator    ::class],
            [static::ATTR_TITLE, StringValidator      ::class],
            [static::ATTR_CONTENT, RequiredValidator    ::class],
            [static::ATTR_CONTENT, StringValidator      ::class],
//            [static::ATTR_IMAGE,    RequiredValidator    ::class],
            [static::ATTR_IMAGE, ImageUploadValidator ::class],
        ];
    }

    /**
     * @inheritDoc
     *
     * @author Pak Sergey
     */
    public function attributeLabels() {
        return [
            static::ATTR_TITLE   => 'Заголовок',
            static::ATTR_CONTENT => 'Контент',
            static::ATTR_IMAGE   => 'Изображение',
        ];
    }

    /**
     * Saving receipt.
     *
     * @return bool
     *
     * @author Pak Sergey
     */
    public function save(): bool {
        if (false === $this->validate()) {
            return false;
        }

        $receipt                = new Receipt();
        $receipt->title         = $this->title;
        $receipt->content       = $this->content;
        $receipt->main_image_id = $this->image;

        return $receipt->save();
    }
}
