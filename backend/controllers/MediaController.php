<?php

namespace backend\controllers;

use backend\models\UpdateMediaForm;
use common\models\Media;
use common\models\Tag;
use Yii;
use yii\web\BadRequestHttpException;

/**
 * Контроллер тэгов.
 *
 * @author Pak Sergey
 */
class MediaController extends BackendController {

    /**
     * Список тэгов.
     *
     * @author Pak Sergey
     */
    public function actionIndex() {
        $media = Media::find()->all();

        return $this->render('index', compact('media'));
    }


    /**
     * Редактирование информации о медиа.
     *
     * @param int $id
     *
     * @return mixed
     *
     * @author Pak Sergey
     */
    public function actionEdit(int $id) {
        $media = Media::findOne([Tag::ATTR_ID => $id]);

        if (null === $media) {
            throw new BadRequestHttpException('Неверные входные параметры');
        }

        $form = new UpdateMediaForm($media);
        if (Yii::$app->request->isPost && $form->load(Yii::$app->request->post()) && $form->save()) {
            return $this->redirect('index');
        }

        return $this->render('edit', compact('form'));
    }
}
