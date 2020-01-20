<?php

namespace common\services;

use common\models\Image;
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
        $path = md5($file->baseName . $file->size) . '.' . $file->extension;
        $file->saveAs(Yii::getAlias('@imagesFolder') . '/' . $path);

        $image       = new Image();
        $image->name = $file->baseName;
        $image->path = $path;
        $image->save();

        return $image->id;
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
