<?php

namespace backend\controllers;

use common\models\Ingredient;
use Yii;
use yii\web\BadRequestHttpException;

/**
 * Контроллер ингредиентов.
 *
 * @author Pak Sergey
 */
class IngredientController extends BackendController {

    /**
     * Добавление ингредиента.
     *
     * @author Pak Sergey
     */
    public function actionAdd(): array {
        Yii::$app->response->format = Yii::$app->response::FORMAT_JSON;

        $title = Yii::$app->request->post('title');

        if (null === $title || '' === trim($title)) {
            throw new BadRequestHttpException('Неверные входные параметры');
        }

        $model        = new Ingredient();
        $model->title = strtolower($title);

        $result = null;
        $model->save();

        return [
            'id'    => $model->id,
            'title' => $model->title,
        ];
    }
}
