<?php

use backend\models\ReceiptIngredientsForm;
use common\models\Ingredient;
use common\models\ReceiptIngredient;
use yii\helpers\Url;

/**
 * Вьюшка виджета ингредиентов рецепта.
 *
 * @var Ingredient[] $ingredients
 * @var ReceiptIngredient[] $receiptIngredients
 *
 * @author Pak Sergey
 */
?>

<?php foreach ($receiptIngredients as $receiptIngredient): ?>
    <div class="form-inline">
        <div class="form-group">
            <select class="form-control" name="<?= ReceiptIngredientsForm::ATTR_INGREDIENTS_IDS . '[]' ?>" data-role="ingredients-select">
                <?php foreach ($ingredients as $ingredient): ?>
                    <option
                        value="<?= $ingredient->id ?>"
                        <?= $ingredient->id === $receiptIngredient->ingredient_id ? 'selected' : null ?>
                    >
                        <?= ucfirst($ingredient->title) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="<?= ReceiptIngredientsForm::ATTR_INGREDIENTS_COUNTS . '[]' ?>" style="width: 60px;" value="<?= $receiptIngredient->count ?>">
        </div>
        <div class="form-group">
            <select class="form-control" name="<?= ReceiptIngredientsForm::ATTR_MEASURE_UNITS . '[]' ?>">
                <?php foreach (Ingredient::MEASURE_UNITS_VARIANTS as $unit): ?>
                    <option value="<?= $unit ?>" <?= $unit === $receiptIngredient->measure_unit ? 'selected' : null ?>><?= $unit ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <a class="btn btn-danger" data-role="remove-ingredient-btn">-</a>
    </div>
<?php endforeach; ?>

<div class="ingredients-input-wrapper">
    <div class="form-inline" data-role="ingredient-template" hidden>
        <div class="form-group">
            <select class="form-control" name="<?= ReceiptIngredientsForm::ATTR_INGREDIENTS_IDS . '[]' ?>" data-role="ingredients-select">
                <?php foreach ($ingredients as $ingredient): ?>
                    <option value="<?= $ingredient->id ?>"><?= ucfirst($ingredient->title) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="<?= ReceiptIngredientsForm::ATTR_INGREDIENTS_COUNTS . '[]' ?>" style="width: 40px;" value="0">
        </div>
        <div class="form-group">
            <select class="form-control" name="<?= ReceiptIngredientsForm::ATTR_MEASURE_UNITS . '[]' ?>">
                <?php foreach (Ingredient::MEASURE_UNITS_VARIANTS as $unit): ?>
                    <option value="<?= $unit ?>"><?= $unit ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <a class="btn btn-danger" data-role="remove-ingredient-btn">-</a>
    </div>
</div>
</br>

<a class="btn btn-primary" data-role="add-ingredient-btn" style="margin-bottom: 10px">Добавить ингредиент</a>

<button type="button" class="btn btn-success" data-toggle="modal" data-target=".create-ingredient-modal" style="margin-bottom: 10px">Создать новый</button>

<div id="create-ingredient-modal" class="modal fade create-ingredient-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="text-align: center">
            <h1>Создавай новый ингредиент!!!</h1>
            <div class="form-group">
                <input type="text" class="ingredient-title">
                <a href="<?= Url::toRoute(['/ingredient/add']) ?>" class="btn btn-success" data-role="create-ingredient-btn">Создать</a>
            </div>
        </div>
    </div>
</div>
