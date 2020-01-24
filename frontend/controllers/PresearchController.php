<?php

namespace frontend\controllers;

use common\models\Tag;
use Yii;
use yii\web\Controller;

/**
 * Class PresearchController
 *
 * @package frontend\controllers
 */
class PresearchController extends Controller {

    /**
     * Пресёч.
     *
     * @param string $q
     *
     * @return mixed
     */
    public function actionIndex(string $q) {
        Yii::$app->response->format = Yii::$app->response::FORMAT_JSON;

        $tags = Tag::find()->where(['ilike', Tag::ATTR_TITLE, $q . '%', false])->all();

        $result = [];
        foreach ($tags as $tag) {
            $result[] = [
                'url'   => '/search?q=' . $tag->id,
                'title' => $tag->title
            ];
        }

        return $result;
    }
}
