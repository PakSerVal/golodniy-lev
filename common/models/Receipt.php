<?php

namespace common\models;

use common\services\ImageService;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * Receipt.
 *
 * @property string $id
 * @property string $title
 * @property string $content
 * @property string $main_image_id
 * @property string $created_at
 */
class Receipt extends ActiveRecord {
    const ATTR_ID            = 'id';
    const ATTR_TITLE         = 'title';
    const ATTR_CONTENT       = 'content';
    const ATTR_MAIN_IMAGE_ID = 'main_image_id';
    const ATTR_CREATED_AT    = 'created_at';

    /**
     * @inheritDoc
     *
     * @return array
     */
    public function behaviors() {
        return [
            [
                'class'              => TimestampBehavior::class,
                'createdAtAttribute' => static::ATTR_CREATED_AT,
                'updatedAtAttribute' => null,
                'value'              => new Expression("TIMEZONE('UTC', NOW())"),
            ],
        ];
    }

    public function getImageUrl() {
        $service = Yii::createObject(ImageService::class); /** @var ImageService $service */

        return $service->getImageUrl($this->main_image_id);
    }
}
