<?php

namespace backend\controllers;

use common\models\ReceiptStep;
use common\models\ReceiptTag;
use common\models\Tag;
use Yii;

/**
 * Контроллер тэгов.
 *
 * @author Pak Sergey
 */
class ReceiptsTagsController extends BackendController {

    /**
     * Удаление тэга.
     *
     * @param int $tagId
     * @param int $receiptId
     *
     * @return array
     *
     * @author Pak Sergey
     */
    public function actionDelete(int $receiptId, int $tagId): array {
        Yii::$app->response->format = Yii::$app->response::FORMAT_JSON;

        ReceiptTag::deleteAll([
            ReceiptTag::ATTR_TAG_ID     => $tagId,
            ReceiptTag::ATTR_RECEIPT_ID => $receiptId,
        ]);

        return ['result' => true];
    }
}
