<?php

declare(strict_types=1);

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Количество просмотров рецепта.
 *
 * @property int $id
 * @property int $receipt_id
 * @property int $count
 *
 * @author Pak Sergey
 */
class ReceiptViewsCount extends ActiveRecord {

    const ID              = 'id';
    const ATTR_RECEIPT_ID = 'receipt_id';
    const ATTR_COUNT      = 'count';
}
