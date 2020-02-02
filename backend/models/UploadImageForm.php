<?php

declare(strict_types=1);

namespace backend\models;

use common\services\ImageService;
use yii\base\Model;
use yii\validators\FileValidator;
use yii\validators\RequiredValidator;
use yii\web\UploadedFile;

/**
 * Upload image form.
 */
class UploadImageForm extends Model {
    const RECEIPT_IMAGE_WIDTH = 750;

    /** @var ImageService */
    private $service;

    /** @var UploadedFile */
    public $file;
    const ATTR_FILE = 'file';

    /**
     * @param ImageService $service
     * @param array        $config
     */
    public function __construct(ImageService $service, $config = []) {
        $this->service = $service;

        parent::__construct($config);
    }

    public function rules() {
        return [
            [static::ATTR_FILE, RequiredValidator::class],
            [static::ATTR_FILE, FileValidator::class, 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    /**
     * Upload image
     *
     * @return int|null
     */
    public function upload(): ?int {
        if ($this->validate()) {
            $imageId = $this->service->upload($this->file);

            if (null !== $imageId) {
                if ($this->service->resize($imageId, static::RECEIPT_IMAGE_WIDTH, 0)) {
                    return $imageId;
                }
            }
        }

        return null;
    }
}
