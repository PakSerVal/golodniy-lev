<?php

declare(strict_types=1);

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Receipt step.
 *
 * @property string $id
 * @property string $title
 *
 * @author Pak Sergey
 */
class Tag extends ActiveRecord {

    const HEALTHY_FOOD_TAG_ID = 39;

    const ATTR_ID    = 'id';
    const ATTR_TITLE = 'title';
}
