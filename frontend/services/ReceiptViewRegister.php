<?php

declare(strict_types=1);

namespace frontend\services;

use common\models\ReceiptViewsCount;

/**
 * Регистрация просмотра рецепта.
 *
 * @author Pak Sergey
 */
class ReceiptViewRegister {

    /**
     * @param int $id Идентификатор рецепта
     *
     * @author Pak Sergey
     */
    public function register(int $id) {
        //todo-23.01.20-pak.s Переделать на аякс и редис когда-нибудь
        $count = ReceiptViewsCount::findOne([ReceiptViewsCount::ATTR_RECEIPT_ID => $id]);
        if (null === $count) {
            $count = new ReceiptViewsCount();
            $count->receipt_id = $id;
        }
        $count->count++;
        $count->save();
    }
}
