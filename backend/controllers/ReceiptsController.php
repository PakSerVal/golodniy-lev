<?php

namespace backend\controllers;

use backend\models\CreateReceiptForm;
use backend\models\UpdateReceiptForm;
use common\models\Receipt;
use Yii;
use yii\web\BadRequestHttpException;

/**
 * Receipts controller
 */
class ReceiptsController extends BackendController {

    /**
     * Receipts homepage.
     *
     * @return string
     *
     * @author Pak Sergey
     */
    public function actionIndex() {
        $receipts = Receipt::find()->all();

        return $this->render('index', compact('receipts'));
    }

    /**
     * Creating receipts.
     *
     * @return mixed
     *
     * @author Pak Sergey
     */
    public function actionCreate() {
        $form = new CreateReceiptForm();

        if (Yii::$app->request->isPost && $form->load(Yii::$app->request->post())) {
            if ($form->save()) {
                return $this->redirect('index');
            }
        }

        return $this->render('create', compact('form'));
    }

    /**
     * Edit receipt.
     *
     * @param int $id
     *
     * @return mixed
     *
     * @author Pak Sergey
     */
    public function actionEdit(int $id) {
        $receipt = Receipt::findOne([Receipt::ATTR_ID => $id]);

        if (null === $receipt) {
            throw new BadRequestHttpException('Неверные входные параметры');
        }

        $form = new UpdateReceiptForm($receipt);
        if (Yii::$app->request->isPost && $form->load(Yii::$app->request->post())) {
            if ($form->save()) {
                return $this->redirect('index');
            }
        }

        return $this->render('edit', compact('form'));
    }

    /**
     * Delete receipt.
     *
     * @param int $id
     *
     * @return mixed
     *
     * @author Pak Sergey
     */
    public function actionDelete(int $id) {
        $receipt = Receipt::findOne([Receipt::ATTR_ID => $id]);

        if (null === $receipt) {
            throw new BadRequestHttpException('Неверные входные параметры');
        }

        $receipt->delete();

        return $this->redirect('index');
    }
}
