<?php

use backend\assets\EditReceiptPage;
use backend\models\UpdateReceiptForm;
use backend\widgets\ReceiptIngredientsInput;
use backend\widgets\ReceiptsStepsInput;
use backend\widgets\ReceiptTagsInput;
use common\widgets\ImageInput;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;

/**
 * @var UpdateReceiptForm $form
 *
 * @author Pak Sergey
 */
?>

<?php Yii::$app->view->registerAssetBundle(EditReceiptPage::class) ?>

<h3>Редактирование рецепта</h3>
<?php $htmlForm = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <?= $htmlForm->field($form, $form::ATTR_TITLE) ?>
    <?= $htmlForm->field($form, $form::ATTR_DESCRIPTION)->textarea(['style' => 'height: 200px'])?>

    <div class="receipt-steps">
        <label>Шаги</label>
        <?php foreach ($form->steps as $step): ?>
            <div class="receipt-step">
                <div><?= $step->content ?></div>
                <img src="<?= $step->getImageUrl() ?>" style="max-width: 300px">
                <?= Html::a('Удалить шаг', Url::toRoute(['/receipt-step/delete', $step::ATTR_ID => $step->id]) , [
                    'class' => 'btn btn-danger',
                    'data-role' => 'delete-step-btn'
                ]) ?>
            </div>
        <?php endforeach; ?>
        <br>
        <?= ReceiptsStepsInput::widget() ?>
    </div>

    <?= $htmlForm->field($form, $form::ATTR_IMAGE)->widget(ImageInput::class) ?>
    <?= $htmlForm->field($form, $form::ATTR_DURATION) ?>
    <?= $htmlForm->field($form, $form::ATTR_PORTIONS_COUNT) ?>
    <?= $htmlForm->field($form, $form::ATTR_VIDEO_URL) ?>

    <div class="receipt-ingredients">
        <label>Ингредиенты</label>
        <?= ReceiptIngredientsInput::draw($form->ingredients) ?>
    </div>
    <br>

    <div class="receipt-tags">
        <label>Тэги</label>
        <?php foreach ($form->tags as $tag): ?>
            <div>
                <span class="receipt-tag">
                <?= $tag->title ?>
                <?= Html::a('-', Url::toRoute(['/receipts-tags/delete', 'tagId' => $tag->id, 'receiptId' => $form->receiptId]) , [
                    'class' => 'btn btn-danger',
                    'data-role' => 'delete-tag-btn'
                ]) ?>
            </span>
            </div>
        <?php endforeach; ?>
        <br>
        <?= ReceiptTagsInput::widget() ?>
    </div>

    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end(); ?>
