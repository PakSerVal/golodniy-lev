<?php

namespace backend\controllers;

use common\models\ReceiptStep;
use Yii;

/**
 * Контроллер для шагов рецепта.
 *
 * @author Pak Sergey
 */
class ReceiptStepController extends BackendController {

    /**
     * Удаление шага рецепта.
     *
     * @param int $id Идентификатор шага
     *
     * @return string[]
     *
     * @author Pak Sergey
     */
    public function actionDelete(int $id): array {
        Yii::$app->response->format = Yii::$app->response::FORMAT_JSON;

        $step = ReceiptStep::findOne($id);

        $result = false;
        if ($step !== null) {
            $result = (bool)$step->delete();
        }

        return ['result' => $result];
    }
}
