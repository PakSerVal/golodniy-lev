<?php

declare(strict_types=1);

namespace backend\models;

use common\models\Tag;
use yii\base\Model;
use yii\validators\RequiredValidator;
use yii\validators\StringValidator;

/**
 * Create tag form.
 *
 * @author Pak Sergey
 */
class CreateTagForm extends Model {

    /** @var string */
    public $title;

    const ATTR_TITLE = 'title';

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

        $tag        = new Tag();
        $tag->title = $this->title;

        return $tag->save();
    }
}
