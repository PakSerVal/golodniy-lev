<?php

declare(strict_types=1);

namespace backend\models;

use common\helpers\validators\ImageUploadValidator;
use common\helpers\validators\IntValValidator;
use common\models\Receipt;
use yii\base\Model;
use yii\validators\RequiredValidator;
use yii\validators\StringValidator;
use yii\web\UploadedFile;

/**
 * Create receipt form.
 *
 * @author Pak Sergey
 */
class CreateReceiptForm extends Model {

    /** @var string */
    public $title;
    const ATTR_TITLE = 'title';

    /** @var string */
    public $description;
    const ATTR_DESCRIPTION = 'description';

    /** @var UploadedFile */
    public $image;
    const ATTR_IMAGE = 'image';

    /** @var string */
    public $duration;
    const ATTR_DURATION = 'duration';

    /** @var string */
    public $portionsCount;
    const ATTR_PORTIONS_COUNT = 'portionsCount';

    /** @var string */
    public $videoUrl;
    const ATTR_VIDEO_URL = 'videoUrl';

    /**
     * @inheritDoc
     *
     * @author Pak Sergey
     */
    public function rules() {
        return [
            [static::ATTR_TITLE,          RequiredValidator    ::class],
            [static::ATTR_TITLE,          StringValidator      ::class],
            [static::ATTR_DESCRIPTION,    StringValidator      ::class],
            [static::ATTR_DURATION,       RequiredValidator    ::class],
            [static::ATTR_DURATION,       IntValValidator      ::class],
            [static::ATTR_PORTIONS_COUNT, RequiredValidator    ::class],
            [static::ATTR_PORTIONS_COUNT, IntValValidator      ::class],
            [static::ATTR_IMAGE,          ImageUploadValidator ::class],
            [static::ATTR_VIDEO_URL,      StringValidator      ::class],
        ];
    }

    /**
     * @inheritDoc
     *
     * @author Pak Sergey
     */
    public function attributeLabels() {
        return [
            static::ATTR_TITLE          => 'Заголовок',
            static::ATTR_DESCRIPTION    => 'Описание',
            static::ATTR_DURATION       => 'Время приготовления в минутах',
            static::ATTR_PORTIONS_COUNT => 'Количество порций',
            static::ATTR_IMAGE          => 'Изображение',
        ];
    }

    /**
     * Saving receipt.
     *
     * @return int|null
     *
     * @author Pak Sergey
     */
    public function save(): ?int {
        if (false === $this->validate()) {
            return null;
        }

        $receipt                 = new Receipt();
        $receipt->title          = $this->title;
        $receipt->description    = $this->description;
        $receipt->main_image_id  = $this->image;
        $receipt->duration       = $this->duration;
        $receipt->portions_count = $this->portionsCount;
        $receipt->video_url      = $this->videoUrl;

        if (false === $receipt->save()) {
            return null;
        }

        return $receipt->id;
    }
}
