<?php

declare(strict_types=1);

namespace frontend\services;

use common\models\ReceiptViewsCount;
use Yii;
use yii\web\Cookie;

/**
 * Регистрация просмотра рецепта.
 *
 * @author Pak Sergey
 */
class ReceiptViewRegister {

    const REGISTERED_RECEIPTS_COOKIE_NAME = 'registered:receipts';

    /**
     * @param int $id Идентификатор рецепта
     *
     * @author Pak Sergey
     */
    public function register(int $id) {
        //todo-23.01.20-pak.s Переделать на аякс и редис когда-нибудь
        $receiptsIds = Yii::$app->request->cookies->getValue(static::REGISTERED_RECEIPTS_COOKIE_NAME, []);

        if (in_array($id, $receiptsIds)) {
            return;
        }

        $receiptsIds[] = $id;
        Yii::$app->response->cookies->add(new Cookie([
            'name'  => static::REGISTERED_RECEIPTS_COOKIE_NAME,
            'value' => $receiptsIds,
        ]));

        $count = ReceiptViewsCount::findOne([ReceiptViewsCount::ATTR_RECEIPT_ID => $id]);
        if (null === $count) {
            $count             = new ReceiptViewsCount();
            $count->receipt_id = $id;
        }
        $count->count++;
        $count->save();
    }
}
