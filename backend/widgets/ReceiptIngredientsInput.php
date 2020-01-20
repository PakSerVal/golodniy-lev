<?php

namespace backend\widgets;

use backend\assets\widgets\ReceiptIngredientsInputBundle;
use common\models\Ingredient;
use common\models\ReceiptIngredient;
use yii\base\Widget;

/**
 * Виджет инпута ингредиентов рецепта.
 *
 * @author Pak Sergey
 */
class ReceiptIngredientsInput extends Widget {

    /** @var ReceiptIngredient[] $receiptIngredients */
    public $receiptIngredients = [];
    const ATTR_RECEIPT_INGREDIENTS = 'receiptIngredients';

    /**
     * @inheritDoc
     *
     * @author Pak Sergey
     */
    public function init() {
        $this->view->registerAssetBundle(ReceiptIngredientsInputBundle::class);

        parent::init();
    }

    /**
     * @param ReceiptIngredient[] $receiptIngredients
     *
     * @return string
     *
     * @author Pak Sergey
     */
    public static function draw(array $receiptIngredients) {
        return static::widget([static::ATTR_RECEIPT_INGREDIENTS => $receiptIngredients]);
    }

    /**
     * @inheritDoc
     *
     * @author Pak Sergey
     */
    public function run() {
        $ingredients = Ingredient::find()->orderBy(Ingredient::ATTR_TITLE)->all();

        return $this->render('receipt-ingredients-input', ['ingredients' => $ingredients, 'receiptIngredients' => $this->receiptIngredients]);
    }
}
