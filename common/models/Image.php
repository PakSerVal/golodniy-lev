<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Image.
 *
 * @property int    $id
 * @property string $name
 * @property string $path
 */
class Image extends ActiveRecord {
    const ATTR_ID    = 'id';
    const ATTR_TITLE = 'name';
    const ATTR_PATH  = 'path';
}
