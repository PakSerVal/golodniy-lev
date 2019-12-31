<?php

use backend\models\CreateReceiptForm;
use common\widgets\ImageInput;
use dosamigos\tinymce\TinyMce;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;

/**
 * @var CreateReceiptForm $form
 */
?>
<h3>Создание рецепта</h3>
<?php $htmlForm = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <?= $htmlForm->field($form, $form::ATTR_TITLE) ?>
    <?= $htmlForm->field($form, $form::ATTR_CONTENT)->widget(TinyMce::class, [
        'options' => ['rows' => 50],
        'language' => 'ru',
        'clientOptions' => [
            'width' => 1000,
            'content_style' => 'body { font-family: "Garamond Regular", serif; }',
            'plugins' => [
                "advlist autolink lists link charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste image"
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            'relative_urls' => false,
            'remove_script_host' => false,
            'convert_urls' => true,
            'images_upload_url' => Url::to('/images/upload'),
            'images_upload_handler' =>
<<<JS
                (function (blobInfo, success, failure) {
                    let xhr, formData;

                    xhr = new XMLHttpRequest();
                    xhr.withCredentials = true;
                    xhr.open('POST', '/images/upload');

                    xhr.onload = function() {
                        let json;

                        if (xhr.status != 200) {
                            failure('HTTP Error: ' + xhr.status);
                            return;
                        }

                        json = JSON.parse(xhr.responseText);

                        if (!json || typeof json.location != 'string') {
                            failure('Invalid JSON: ' + xhr.responseText);
                            return;
                        }

                        success(json.location);
                    };

                    formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());

                    xhr.send(formData);
                })();
JS
        ]
    ]) ?>
    <?= $htmlForm->field($form, $form::ATTR_IMAGE)->widget(ImageInput::class) ?>
    <?= Html::submitButton('Создать', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>
