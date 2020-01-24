<?php

namespace backend\controllers;

use backend\models\CreateTagForm;
use backend\models\UpdateTagForm;
use common\models\Receipt;
use common\models\ReceiptTag;
use common\models\Tag;
use Exception;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Response;

/**
 * Контроллер тэгов.
 *
 * @author Pak Sergey
 */
class TagsController extends BackendController {

    /**
     * Список тэгов.
     *
     * @author Pak Sergey
     */
    public function actionIndex() {
        $tags = Tag::find()->orderBy(Tag::ATTR_TITLE)->all();

        return $this->render('index', compact('tags'));
    }

    /**
     * Создание тэга.
     *
     * @return mixed
     *
     * @author Pak Sergey
     */
    public function actionCreate() {
        $form = new CreateTagForm();

        if (Yii::$app->request->isPost && $form->load(Yii::$app->request->post()) && $form->save()) {
            return $this->redirect('index');
        }

        return $this->render('create', compact('form'));
    }


    /**
     * Редактирование тэга.
     *
     * @param int $id
     *
     * @return mixed
     *
     * @author Pak Sergey
     */
    public function actionEdit(int $id) {
        $tag = Tag::findOne([Tag::ATTR_ID => $id]);

        if (null === $tag) {
            throw new BadRequestHttpException('Неверные входные параметры');
        }

        $form = new UpdateTagForm($tag);
        if (Yii::$app->request->isPost && $form->load(Yii::$app->request->post()) && $form->save()) {
            return $this->redirect('index');
        }

        return $this->render('edit', compact('form'));
    }

    /**
     * Удаление тэга.
     *
     * @param int $id
     *
     * @return Response
     *
     * @author Pak Sergey
     */
    public function actionDelete(int $id) {
        $tag = Tag::findOne([Receipt::ATTR_ID => $id]);

        if (null === $tag) {
            throw new BadRequestHttpException('Неверные входные параметры');
        }

        $transaction = Yii::$app->db->beginTransaction();

        try {
            $tag->delete();
            ReceiptTag::deleteAll([ReceiptTag::ATTR_TAG_ID => $id]);

            $transaction->commit();
        }
        catch (Exception $e) {
            $transaction->rollBack();
        }

        return $this->redirect('index');
    }


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
