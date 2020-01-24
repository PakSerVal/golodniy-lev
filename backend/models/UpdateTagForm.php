<?php

declare(strict_types=1);

namespace backend\models;

use common\models\Tag;
use yii\base\Model;
use yii\validators\RequiredValidator;
use yii\validators\StringValidator;

/**
 * Edit tag form.
 *
 * @author Pak Sergey
 */
class UpdateTagForm extends Model {

    /** @var string */
    public $title;
    const ATTR_TITLE = 'title';

    /** @var Tag $model */
    public $model;

    /**
     * @inheritDoc
     *
     * @param array $config
     */
    public function __construct(Tag $tag, array $config = []) {
        $this->title = $tag->title;
        $this->model = $tag;

        parent::__construct($config);
    }

    /**
     * @inheritDoc
     *
     * @author Pak Sergey
     */
    public function rules() {
        return [
            [static::ATTR_TITLE, RequiredValidator    ::class],
            [static::ATTR_TITLE, StringValidator      ::class],
        ];
    }

    /**
     * @inheritDoc
     *
     * @author Pak Sergey
     */
    public function attributeLabels() {
        return [
            static::ATTR_TITLE => 'Заголовок',
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

        $this->model->title = $this->title;

        return $this->model->save();
    }
}
