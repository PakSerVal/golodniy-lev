<?php

use backend\models\CreateTagForm;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/**
 * @var CreateTagForm $form
 *
 * @author Pak Sergey
 */
?>
<h3>Создание тэга</h3>
<?php $htmlForm = ActiveForm::begin() ?>
    <?= $htmlForm->field($form, $form::ATTR_TITLE) ?>

    <div>
        <?= Html::submitButton('Создать', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>
