<?php

declare(strict_types=1);

namespace common\helpers\validators;

use yii\validators\FilterValidator;

class IntValValidator extends FilterValidator {
    public $filter = 'intval';
}
