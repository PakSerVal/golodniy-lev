<?php

use backend\models\UpdateTagForm;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/**
 * @var UpdateTagForm $form
 *
 * @author Pak Sergey
 */
?>

<h3>Редактирование тэга</h3>
<?php $htmlForm = ActiveForm::begin() ?>
    <?= $htmlForm->field($form, $form::ATTR_TITLE) ?>
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end(); ?>
