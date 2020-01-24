<?php

declare(strict_types=1);

namespace backend\models;

use common\helpers\validators\IntValValidator;
use common\models\Media;
use yii\base\Model;
use yii\validators\RequiredValidator;

/**
 * Edit meida form.
 *
 * @author Pak Sergey
 */
class UpdateMediaForm extends Model {

    /** @var string */
    public $count;
    const ATTR_COUNT = 'count';

    /** @var Media $model */
    public $model;

    /**
     * @inheritDoc
     *
     * @param array $config
     */
    public function __construct(Media $media, array $config = []) {
        $this->count = $media->count;
        $this->model = $media;

        parent::__construct($config);
    }

    /**
     * @inheritDoc
     *
     * @author Pak Sergey
     */
    public function rules() {
        return [
            [static::ATTR_COUNT, RequiredValidator ::class],
            [static::ATTR_COUNT, IntValValidator   ::class],
        ];
    }

    /**
     * @inheritDoc
     *
     * @author Pak Sergey
     */
    public function attributeLabels() {
        return [
            static::ATTR_COUNT => 'Количество',
        ];
    }

    /**
     * Saving tag.
     *
     * @return bool
     *
     * @author Pak Sergey
     */
    public function save(): bool {
        if (false === $this->validate()) {
            return false;
        }

        $this->model->count = $this->count;

        return $this->model->save();
    }
}
