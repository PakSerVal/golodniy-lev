<?php

namespace common\services;

use common\models\Image;
use Imagick;
use Yii;
use yii\web\UploadedFile;

class ImageService {

    /**
     * @param int $id Image id
     *
     * @return string|null
     */
    public function getImageUrl(int $id): ?string {
        $model = Image::findOne([Image::ATTR_ID => $id]);

        if (null === $model) {
            return null;
        }

        return $this->generateUrl($model->path);
    }

    /**
     * @param UploadedFile $file
     *
     * @return int
     */
    public function upload(UploadedFile $file): int {
        $urlPath = md5($file->baseName . $file->size) . '.' . $file->extension;
        $file->saveAs(Yii::getAlias('@imagesFolder') . '/' . $urlPath);

        $image       = new Image();
        $image->name = $file->baseName;
        $image->path = $urlPath;
        $image->save();

        return $image->id;
    }

    /**
     * @param int  $imageId
     * @param int  $width
     * @param int  $height
     *
     * @return bool
     *
     * @author Pak Sergey
     */
    public function resize(int $imageId, int $width, int $height) {
        $urlPath = Image::find()->select(Image::ATTR_PATH)->where([Image::ATTR_ID => $imageId])->scalar();
        $urlPath = Yii::getAlias('@imagesFolder') . '/' . $urlPath;

        if (!$urlPath || false === file_exists($urlPath)) {
            return  false;
        }

        $i = new Imagick($urlPath);
        $i->thumbnailImage($width, $height);

        return $i->writeImage($urlPath);
    }

    /**
     * @param string $path
     *
     * @return string
     */
    private function generateUrl(string $path): string {
        return Yii::$app->params['staticUrl'] . '/images/' . $path;
    }
}
