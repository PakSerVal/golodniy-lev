<?php

declare(strict_types=1);

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Медиа.
 *
 * @property int    $id
 * @property string $name
 * @property int    $count
 *
 * @author Pak Sergey
 */
class Media extends ActiveRecord {

    const MEDIA_YOUTUBE_ID   = 1;
    const MEDIA_INSTAGRAM_ID = 2;

    const ATTR_ID    = 'id';
    const ATTR_NAME  = 'name';
    const ATTR_COUNT = 'count';
}
