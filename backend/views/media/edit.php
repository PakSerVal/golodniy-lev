<?php

use backend\models\UpdateMediaForm;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/**
 * @var UpdateMediaForm $form
 *
 * @author Pak Sergey
 */
?>

<h3>Редактирование тэга</h3>
<?php $htmlForm = ActiveForm::begin() ?>
    <?= $htmlForm->field($form, $form::ATTR_COUNT) ?>
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end(); ?>
