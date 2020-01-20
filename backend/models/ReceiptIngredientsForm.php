<?php

declare(strict_types=1);

namespace backend\models;

use common\helpers\validators\IntValValidator;
use common\models\ReceiptIngredient;
use yii\base\Model;
use yii\validators\EachValidator;
use yii\validators\RequiredValidator;
use yii\validators\StringValidator;

/**
 * Форма ингредиентов рецепта.
 *
 * @author Pak Sergey
 */
class ReceiptIngredientsForm extends Model {

    public $receiptId;

    /** @var int[] */
    public $ingredientsIds = [];
    const ATTR_INGREDIENTS_IDS = 'ingredientsIds';

    /** @var string[] */
    public $ingredientsCounts = [];
    const ATTR_INGREDIENTS_COUNTS = 'ingredientsCounts';

    /** @var string[] */
    public $measureUnits = [];
    const ATTR_MEASURE_UNITS = 'measureUnits';

    /**
     * @inheritDoc
     *
     * @author Pak Sergey
     */
    public function rules() {
        return [
            [static::ATTR_INGREDIENTS_IDS, RequiredValidator::class],
            [static::ATTR_INGREDIENTS_IDS, EachValidator ::class, 'rule' => [IntValValidator::class]],
            [static::ATTR_INGREDIENTS_COUNTS, RequiredValidator::class],
            [static::ATTR_INGREDIENTS_COUNTS, EachValidator ::class, 'rule' => [StringValidator::class]],
            [static::ATTR_MEASURE_UNITS, RequiredValidator::class],
            [static::ATTR_MEASURE_UNITS, EachValidator ::class, 'rule' => [StringValidator::class]],
        ];
    }

    /**
     * Сохранение формы.
     *
     * @author Pak Sergey
     */
    public function save() {
        if (false === $this->validate()) {
            return false;
        }

        if (count($this->ingredientsIds) === 0 || count($this->ingredientsIds) !== count($this->ingredientsCounts) || count($this->ingredientsIds) !== count($this->measureUnits)) {
            return false;
        }

        ReceiptIngredient::deleteAll([ReceiptIngredient::ATTR_RECEIPT_ID => $this->receiptId]);

        foreach ($this->ingredientsIds as $i => $ingredientId) {
            $receiptIngredient                = new ReceiptIngredient();
            $receiptIngredient->receipt_id    = $this->receiptId;
            $receiptIngredient->ingredient_id = $ingredientId;
            $receiptIngredient->count         = $this->ingredientsCounts[$i];
            $receiptIngredient->measure_unit  = $this->measureUnits[$i];

            $receiptIngredient->save();
        }

        return true;
    }
}
