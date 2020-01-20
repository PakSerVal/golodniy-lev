<?php

declare(strict_types=1);

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Receipt ingredient.
 *
 * @property int    $id
 * @property int    $receipt_id
 * @property int    $ingredient_id
 * @property string $count
 * @property string $measure_unit
 *
 * @author Pak Sergey
 */
class ReceiptIngredient extends ActiveRecord {

    const ATTR_ID            = 'id';
    const ATTR_RECEIPT_ID    = 'receipt_id';
    const ATTR_INGREDIENT_ID = 'ingredient_id';
    const ATTR_COUNT         = 'count';
    const ATTR_MEASURE_UNIT  = 'measure_unit';
}
