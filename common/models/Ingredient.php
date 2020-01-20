<?php

declare(strict_types=1);

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Модель ингредиентов.
 *
 * @property string $id
 * @property string $title
 *
 * @author Pak Sergey
 */
class Ingredient extends ActiveRecord {

    const ATTR_ID    = 'id';
    const ATTR_TITLE = 'title';

    const MEASURE_UNITS_VARIANTS = [
        'г.',
        'мг.',
        'л.',
        'мл.',
        'шт.',
        'по вкусу',
        'ст. л.'
    ];
}
