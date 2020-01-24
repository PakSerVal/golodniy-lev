<?php

namespace backend\controllers;

use backend\models\UpdateIngredientForm;
use common\models\Ingredient;
use common\models\Receipt;
use common\models\ReceiptIngredient;
use Exception;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Response;

/**
 * Контроллер ингредиентов.
 *
 * @author Pak Sergey
 */
class IngredientsController extends BackendController {

    /**
     * Главная страница ингредиентов.
     *
     * @author Pak Sergey
     */
    public function actionIndex() {
        $ingredients = Ingredient::find()->orderBy(Ingredient::ATTR_TITLE)->all();

        return $this->render('index', compact('ingredients'));
    }

    /**
     * Редактирование ингредиента.
     *
     * @param int $id
     *
     * @return mixed
     *
     * @author Pak Sergey
     */
    public function actionEdit(int $id) {
        $ingredient = Ingredient::findOne([Ingredient::ATTR_ID => $id]);

        if (null === $ingredient) {
            throw new BadRequestHttpException('Неверные входные параметры');
        }

        $form = new UpdateIngredientForm($ingredient);
        if (Yii::$app->request->isPost && $form->load(Yii::$app->request->post()) && $form->save()) {
            return $this->redirect('index');
        }

        return $this->render('edit', compact('form'));
    }

    /**
     * Удаление ингредиента.
     *
     * @param int $id
     *
     * @return Response
     *
     * @author Pak Sergey
     */
    public function actionDelete(int $id) {
        $ingredient = Ingredient::findOne([Receipt::ATTR_ID => $id]);

        if (null === $ingredient) {
            throw new BadRequestHttpException('Неверные входные параметры');
        }

        $transaction = Yii::$app->db->beginTransaction();

        try {
            $ingredient->delete();
            ReceiptIngredient::deleteAll([ReceiptIngredient::ATTR_INGREDIENT_ID => $id]);

            $transaction->commit();
        }
        catch (Exception $e) {
            $transaction->rollBack();
        }

        return $this->redirect('index');
    }


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

        if (null !== Ingredient::findOne([Ingredient::ATTR_TITLE => $title])) {
            throw new BadRequestHttpException('Такой ингредиент уже есть');
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
