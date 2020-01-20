<?php

namespace backend\controllers;

use backend\models\CreateReceiptForm;
use backend\models\ReceiptIngredientsForm;
use backend\models\ReceiptStepsForm;
use backend\models\ReceiptTagsForm;
use backend\models\UpdateReceiptForm;
use common\models\Receipt;
use common\models\ReceiptIngredient;
use common\models\ReceiptStep;
use Exception;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\UploadedFile;

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
        $receipts = Receipt::find()->orderBy([Receipt::ATTR_CREATED_AT => SORT_DESC])->all();

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
            $id = $form->save();

            if ($id !== null) {
                $stepForm                = new ReceiptStepsForm();
                $stepForm->receiptId     = $id;
                $stepForm->stepsContents = Yii::$app->request->post($stepForm::ATTR_STEP_CONTENTS);
                $stepForm->setStepsImages(UploadedFile::getInstancesByName($stepForm::ATTR_STEP_IMAGES));
                $stepForm->save();

                $ingredientsForm                    = new ReceiptIngredientsForm();
                $ingredientsForm->receiptId         = $id;
                $ingredientsForm->ingredientsIds    = Yii::$app->request->post($ingredientsForm::ATTR_INGREDIENTS_IDS);
                $ingredientsForm->ingredientsCounts = Yii::$app->request->post($ingredientsForm::ATTR_INGREDIENTS_COUNTS);
                $ingredientsForm->measureUnits      = Yii::$app->request->post($ingredientsForm::ATTR_MEASURE_UNITS);
                $ingredientsForm->save();

                $tagsForm            = new ReceiptTagsForm();
                $tagsForm->receiptId = $id;
                $tagsForm->tags      = Yii::$app->request->post($tagsForm::ATTR_TAGS);
                $tagsForm->save();

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
                $stepForm                = new ReceiptStepsForm();
                $stepForm->receiptId     = $id;
                $stepForm->stepsContents = Yii::$app->request->post($stepForm::ATTR_STEP_CONTENTS);
                $stepForm->setStepsImages(UploadedFile::getInstancesByName($stepForm::ATTR_STEP_IMAGES));
                $stepForm->save();

                $ingredientsForm                    = new ReceiptIngredientsForm();
                $ingredientsForm->receiptId         = $id;
                $ingredientsForm->ingredientsIds    = Yii::$app->request->post($ingredientsForm::ATTR_INGREDIENTS_IDS);
                $ingredientsForm->ingredientsCounts = Yii::$app->request->post($ingredientsForm::ATTR_INGREDIENTS_COUNTS);
                $ingredientsForm->measureUnits      = Yii::$app->request->post($ingredientsForm::ATTR_MEASURE_UNITS);
                $ingredientsForm->save();

                $tagsForm            = new ReceiptTagsForm();
                $tagsForm->receiptId = $id;
                $tagsForm->tags      = Yii::$app->request->post($tagsForm::ATTR_TAGS);
                $tagsForm->save();

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

        $transaction = Yii::$app->db->beginTransaction();

        try {
            $receipt->delete();

            ReceiptIngredient::deleteAll([ReceiptIngredient::ATTR_RECEIPT_ID => $id]);
            ReceiptStep::deleteAll([ReceiptStep::ATTR_RECEIPT_ID => $id]);

            $transaction->commit();
        }
        catch (Exception $e) {
            $transaction->rollBack();
        }

        return $this->redirect('index');
    }
}
