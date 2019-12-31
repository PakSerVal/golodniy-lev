<?php

namespace backend\controllers;

use backend\models\UploadImageForm;
use common\services\ImageService;
use Yii;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * Images controller
 *
 * @author Pak Sergey
 */
class ImagesController extends BackendController {
    const ACTION_UPLOAD = 'upload';

    public $enableCsrfValidation = false;

    /**
     * Upload image.
     *
     * @author Pak Sergey
     */
    public function actionUpload() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $form       = Yii::createObject(UploadImageForm::class);/** @var UploadImageForm $form */
        $form->file = UploadedFile::getInstanceByName($form::ATTR_FILE);
        $imageId    = $form->upload();

        $url = '';
        if (null !== $imageId) {
            $imageService = Yii::createObject(ImageService::class);/** @var ImageService $imageService */
            $url          = $imageService->getImageUrl($imageId);
        }

        return ['location' => $url];
    }
}
