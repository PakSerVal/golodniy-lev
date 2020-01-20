<?php

declare(strict_types=1);

namespace backend\models;

use common\helpers\validators\ImageUploadValidator;
use common\helpers\validators\IntValValidator;
use common\models\Ingredient;
use common\models\Receipt;
use common\models\ReceiptIngredient;
use common\models\ReceiptStep;
use common\models\ReceiptTag;
use common\models\Tag;
use yii\base\Model;
use yii\validators\RequiredValidator;
use yii\validators\StringValidator;
use yii\web\UploadedFile;

/**
 * Update receipt form.
 *
 * @author Pak Sergey
 */
class UpdateReceiptForm extends Model {

    /** @var string */
    public $receiptId;
    const ATTR_RECEIPT_ID = 'receiptId';

    /** @var string */
    public $title;
    const ATTR_TITLE = 'title';

    /** @var string */
    public $description;
    const ATTR_DESCRIPTION = 'description';

    /** @var UploadedFile */
    public $image;
    const ATTR_IMAGE = 'image';

    /** @var int */
    public $duration;
    const ATTR_DURATION = 'duration';

    /** @var string */
    public $portionsCount;
    const ATTR_PORTIONS_COUNT = 'portionsCount';

    /** @var string */
    public $videoUrl;
    const ATTR_VIDEO_URL = 'videoUrl';

    /** @var ReceiptStep[] */
    public $steps;
    const ATTR_STEPS = 'steps';

    /** @var Tag[] */
    public $tags;
    const ATTR_TAGS = 'tags';

    /** @var ReceiptIngredient[] */
    public $ingredients;
    const ATTR_INGREDIENTS = 'ingredients';

    /** @var Receipt $model */
    private $model;

    /**
     * @inheritDoc
     *
     * @author Pak Sergey
     */
    public function __construct(Receipt $receipt, $config = []) {
        $this->receiptId     = $receipt->id;
        $this->title         = $receipt->title;
        $this->description   = $receipt->description;
        $this->image         = $receipt->main_image_id;
        $this->duration      = $receipt->duration;
        $this->portionsCount = $receipt->portions_count;
        $this->videoUrl      = $receipt->video_url;

        $this->steps   = ReceiptStep::find()
            ->where([ReceiptStep::ATTR_RECEIPT_ID => $receipt->id])
            ->orderBy(ReceiptStep::ATTR_NUMBER)
            ->all();
        ;

        $this->ingredients = ReceiptIngredient::find()
            ->where([ReceiptIngredient::ATTR_RECEIPT_ID => $receipt->id])
            ->all();
        ;

        $this->tags = Tag::find()
            ->innerJoin(ReceiptTag::tableName(), Tag::tableName() . '.' . Tag::ATTR_ID . '=' . ReceiptTag::tableName() . '.' . ReceiptTag::ATTR_TAG_ID)
            ->where([ReceiptTag::ATTR_RECEIPT_ID => $receipt->id])
            ->all()
        ;

        $this->model = $receipt;

        parent::__construct($config);
    }

    /**
     * @inheritDoc
     *
     * @author Pak Sergey
     */
    public function rules() {
        return [
            [static::ATTR_TITLE,          RequiredValidator    ::class],
            [static::ATTR_TITLE,          StringValidator      ::class],
            [static::ATTR_DESCRIPTION,    StringValidator      ::class],
            [static::ATTR_DURATION,       RequiredValidator    ::class],
            [static::ATTR_DURATION,       IntValValidator      ::class],
            [static::ATTR_PORTIONS_COUNT, RequiredValidator    ::class],
            [static::ATTR_PORTIONS_COUNT, IntValValidator      ::class],
            [static::ATTR_VIDEO_URL,      StringValidator      ::class],
            [static::ATTR_TITLE,          StringValidator      ::class],
            [static::ATTR_IMAGE,          ImageUploadValidator ::class],
        ];
    }

    /**
     * @inheritDoc
     *
     * @author Pak Sergey
     */
    public function attributeLabels() {
        return [
            static::ATTR_TITLE          => 'Заголовок',
            static::ATTR_DESCRIPTION    => 'Описание',
            static::ATTR_DURATION       => 'Время приготовления в минутах',
            static::ATTR_PORTIONS_COUNT => 'Количество порций',
            static::ATTR_STEPS          => 'Шаги',
            static::ATTR_IMAGE          => 'Изображение',
        ];
    }

    /**
     * Saving receipt.
     *
     * @return bool
     *
     * @author Pak Sergey
     */
    public function save(): bool {
        if (false === $this->validate()) {
            return false;
        }

        $this->model->title          = $this->title;
        $this->model->description    = $this->description;
        $this->model->main_image_id  = $this->image;
        $this->model->duration       = $this->duration;
        $this->model->portions_count = $this->portionsCount;
        $this->model->video_url      = $this->videoUrl;

        return $this->model->save();
    }
}
