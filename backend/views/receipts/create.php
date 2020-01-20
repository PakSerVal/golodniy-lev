<?php

use backend\models\CreateReceiptForm;
use backend\widgets\ReceiptIngredientsInput;
use backend\widgets\ReceiptsStepsInput;
use backend\widgets\ReceiptTagsInput;
use common\widgets\ImageInput;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/**
 * @var CreateReceiptForm $form
 *
 * @author Pak Sergey
 */
?>
<h3>Создание рецепта</h3>
<?php $htmlForm = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <?= $htmlForm->field($form, $form::ATTR_TITLE) ?>
    <?= $htmlForm->field($form, $form::ATTR_DESCRIPTION)->textarea(['style' => 'height: 200px'])?>

    <label>Шаги рецепта</label>
    <?= ReceiptsStepsInput::widget(); ?>

    <?= $htmlForm->field($form, $form::ATTR_IMAGE)->widget(ImageInput::class) ?>
    <?= $htmlForm->field($form, $form::ATTR_DURATION) ?>
    <?= $htmlForm->field($form, $form::ATTR_PORTIONS_COUNT) ?>
    <?= $htmlForm->field($form, $form::ATTR_VIDEO_URL) ?>

    <label>Ингредиенты</label>
    <?= ReceiptIngredientsInput::widget(); ?>

    <div>
        <label>Тэги</label>
        <?= ReceiptTagsInput::widget(); ?>
    </div>

    <div>
        <?= Html::submitButton('Создать', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>
