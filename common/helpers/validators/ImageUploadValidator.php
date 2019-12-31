<?php

declare(strict_types=1);

namespace common\helpers\validators;

use backend\models\UploadImageForm;
use Yii;
use yii\validators\Validator;
use yii\web\UploadedFile;

class ImageUploadValidator extends Validator {

    public $skipOnEmpty = false;

    /**
     * @inheritDoc
     *
     * @param $model
     * @param $attribute
     *
     * @author Pak Sergey
     */
    public function validateAttribute($model, $attribute) {
        $form       = Yii::createObject(UploadImageForm::class);/** @var UploadImageForm $form */
        $form->file = UploadedFile::getInstance($model, $attribute);
        $imageId    = $form->upload();

        if (('' === $model->$attribute || null === $model->$attribute) && null === $imageId) {
            $this->addError($model, $attribute, Yii::t('yii', 'Не удалось загрузить изображение'));
        }

        $model->$attribute = $imageId ?? (int) $model->$attribute;
    }
}
