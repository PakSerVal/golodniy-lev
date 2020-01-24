<?php

use backend\models\UpdateIngredientForm;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/**
 * @var UpdateIngredientForm $form
 *
 * @author Pak Sergey
 */
?>

<h3>Редактирование ингредиента</h3>
<?php $htmlForm = ActiveForm::begin() ?>
    <?= $htmlForm->field($form, $form::ATTR_TITLE) ?>
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end(); ?>
