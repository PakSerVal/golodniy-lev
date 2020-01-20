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
class TagsController extends BackendController {

    /**
     * Пресёч тэгов.
     *
     * @param string $q
     *
     * @return array
     *
     * @author Pak Sergey
     */
    public function actionPresearch(string $q): array {
        Yii::$app->response->format = Yii::$app->response::FORMAT_JSON;

        $suggests = Tag::find()->select(Tag::ATTR_TITLE)->where(['ilike', Tag::ATTR_TITLE, $q . '%', false])->column();

        return [
            'suggests' => $suggests,
        ];
    }
}
