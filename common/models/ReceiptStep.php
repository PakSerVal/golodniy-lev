<?php

declare(strict_types=1);

namespace common\models;

use common\services\ImageService;
use Yii;
use yii\db\ActiveRecord;

/**
 * Receipt step.
 *
 * @property string $id
 * @property string $content
 * @property string $image_id
 * @property int    $number
 * @property int    $receipt_id
 *
 * @author Pak Sergey
 */
class ReceiptStep extends ActiveRecord {

    const ATTR_ID         = 'id';
    const ATTR_CONTENT    = 'content';
    const ATTR_IMAGE_ID   = 'image_id';
    const ATTR_NUMBER     = 'number';
    const ATTR_RECEIPT_ID = 'receipt_id';

    /**
     * Получение ссылки на изображение шага.
     *
     * @return string|null
     *
     * @author Pak Sergey
     */
    public function getImageUrl(): ?string {
        if ($this->image_id === null) {
            return null;
        }

        $service = Yii::createObject(ImageService::class); /** @var ImageService $service */

        return $service->getImageUrl($this->image_id);
    }
}
