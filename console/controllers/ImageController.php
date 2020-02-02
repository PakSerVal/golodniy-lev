<?php

namespace console\controllers;

use backend\models\UploadImageForm;
use common\models\Image;
use common\services\ImageService;
use Yii;
use yii\base\Controller;

class ImageController extends Controller {
    public function actionOptimize() {
        $images = Image::find()->all(); /** @var Image[] $images */

        $service = Yii::createObject(ImageService::class); /** @var ImageService $service */

        echo "\n";
        foreach ($images as $image) {
            $service->resize($image->id, UploadImageForm::RECEIPT_IMAGE_WIDTH, 0);
            echo $image->path;
            echo "\n";
        }
    }
}
