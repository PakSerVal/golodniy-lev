<?php

declare(strict_types=1);

namespace backend\models;

use common\models\Ingredient;
use yii\base\Model;
use yii\validators\RequiredValidator;
use yii\validators\StringValidator;

/**
 * Update ingredient form.
 *
 * @author Pak Sergey
 */
class UpdateIngredientForm extends Model {

    /** @var string */
    public $title;
    const ATTR_TITLE = 'title';

    /** @var Ingredient $model */
    private $model;

    /**
     * @inheritDoc
     *
     * @author Pak Sergey
     */
    public function __construct(Ingredient $ingredient, $config = []) {
        $this->title = $ingredient->title;
        $this->model = $ingredient;

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

        $this->model->title = $this->title;

        return $this->model->save();
    }
}
