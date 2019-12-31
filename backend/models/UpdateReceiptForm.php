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
 * Update receipt form.
 *
 * @author Pak Sergey
 */
class UpdateReceiptForm extends Model {

    /** @var string */
    public $title;
    const ATTR_TITLE = 'title';

    /** @var string */
    public $content;
    const ATTR_CONTENT = 'content';

    /** @var UploadedFile */
    public $image;
    const ATTR_IMAGE = 'image';

    /** @var Receipt $model */
    private $model;

    /**
     * @inheritDoc
     *
     * @author Pak Sergey
     */
    public function __construct(Receipt $receipt, $config = []) {
        $this->title   = $receipt->title;
        $this->content = $receipt->content;
        $this->image   = $receipt->main_image_id;

        $this->model = $receipt;

        parent::__construct($config);
    }

    /**
     * @inheritDoc
     *
     * @author Pak Sergey
     */
    public function rules() {
        return [
            [static::ATTR_TITLE,   RequiredValidator    ::class],
            [static::ATTR_TITLE,   StringValidator      ::class],
            [static::ATTR_CONTENT, RequiredValidator    ::class],
            [static::ATTR_CONTENT, StringValidator      ::class],
            [static::ATTR_IMAGE,   ImageUploadValidator ::class],
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

        $this->model->title         = $this->title;
        $this->model->content       = $this->content;
        $this->model->main_image_id = $this->image;

        return $this->model->save();
    }
}
