<?php

declare(strict_types=1);

namespace common\helpers;

/**
 * String helper.
 *
 * @author Pak Sergey
 */
class StringHelper extends \yii\helpers\StringHelper {

    /**
     * @param int    $count
     * @param array  $cases
     *
     * @return string
     *
     * @author Pak Sergey
     */
    public static function countPostfix(int $count, array $cases): string {
        $countString = preg_replace('/[^\d]+/', '', $count);// Удаляем всё, кроме чисел

        // -- -- -- --
        $caseIndex = self::getCountPostfixForm((int)$countString);
        $result    = $cases[$caseIndex];

        return $count . ' ' . $result;
    }

    /**
     * @param int $num
     *
     * @return int
     *
     * @author Pak Sergey
     */
    public static function getCountPostfixForm(int $num): int {
        $num  = abs($num);

        $two = $num % 100;
        $one = $num % 10;

        if (10 <= $two && $two <= 20) {
            return 2;
        }

        if (0 === $one) {
            return 2;
        }
        elseif (1 === $one) {
            return 0;
        }
        elseif (2 <= $one && $one <= 4) {
            return 1;
        }

        return 2;
    }
}
