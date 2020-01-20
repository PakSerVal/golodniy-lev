<?php

declare(strict_types=1);

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Receipt step.
 *
 * @property int $receipt_id
 * @property int $tag_id
 *
 * @author Pak Sergey
 */
class ReceiptTag extends ActiveRecord {

    const ATTR_RECEIPT_ID = 'receipt_id';
    const ATTR_TAG_ID     = 'tag_id';
}
