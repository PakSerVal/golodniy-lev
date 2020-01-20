<?php

declare(strict_types=1);

namespace backend\models;

use common\helpers\validators\IntValValidator;
use common\models\Receipt;
use common\models\ReceiptStep;
use common\services\ImageService;
use Yii;
use yii\base\Model;
use yii\validators\EachValidator;
use yii\validators\RequiredValidator;
use yii\validators\StringValidator;
use yii\web\UploadedFile;

/**
 * Create receipt form.
 *
 * @author Pak Sergey
 */
class ReceiptStepsForm extends Model {

    /** @var string[] */
    public $stepsContents = [];
    const ATTR_STEP_CONTENTS = 'stepsContents';

    /** @var int[] */
    public $stepsImages = [];
    const ATTR_STEP_IMAGES = 'stepsImages';

    public $receiptId;

    /**
     * @inheritDoc
     *
     * @author Pak Sergey
     */
    public function rules() {
        return [
            [static::ATTR_STEP_CONTENTS, RequiredValidator::class],
            [static::ATTR_STEP_CONTENTS, EachValidator ::class, 'rule' => [StringValidator::class]],
            [static::ATTR_STEP_IMAGES,   EachValidator ::class, 'rule' => [IntValValidator::class]],
        ];
    }

    /**
     * Сеттинг изображений.
     *
     * @param UploadedFile[] $files
     *
     * @author Pak Sergey
     */
    public function setStepsImages(array $files) {
        $ids     = [];
        $service = Yii::createObject(ImageService::class); /** @var ImageService $service */

        foreach ($files as $file) {
            $ids[] = $service->upload($file);
        }

        $this->stepsImages = $ids;
    }

    /**
     * Сохранение формы.
     *
     * @author Pak Sergey
     */
    public function save() {
        if (null === $this->stepsContents || 0 === count($this->stepsContents)) {
            return true;
        }

        if (false === $this->validate()) {
            return false;
        }

        $seed = ReceiptStep::find()->max(ReceiptStep::ATTR_NUMBER) ?? 0;

        foreach ($this->stepsContents as $i => $content) {
            $step             = new ReceiptStep();
            $step->number     = $seed + $i + 1;
            $step->content    = $content;
            $step->receipt_id = $this->receiptId;

            if (array_key_exists($i, $this->stepsImages)) {
                $step->image_id = $this->stepsImages[$i];
            }

            if (false === $step->save()) {
                return false;
            }
        }

        return true;
    }
}
