<?php

declare(strict_types=1);

namespace backend\models;

use common\models\ReceiptTag;
use common\models\Tag;
use Exception;
use Yii;
use yii\base\Model;
use yii\validators\EachValidator;
use yii\validators\RequiredValidator;
use yii\validators\StringValidator;

/**
 * Форма для тэгов рецепта.
 *
 * @author Pak Sergey
 */
class ReceiptTagsForm extends Model {

    /** @var string[] */
    public $tags = [];
    const ATTR_TAGS = 'tags';

    /** @var string */
    public $receiptId;

    /**
     * @inheritDoc
     *
     * @author Pak Sergey
     */
    public function rules() {
        return [
            [static::ATTR_TAGS, RequiredValidator::class],
            [static::ATTR_TAGS, EachValidator ::class, 'rule' => [StringValidator::class]],
        ];
    }

    /**
     * Сохранение формы.
     *
     * @author Pak Sergey
     */
    public function save() {
        if (false === $this->validate()) {
            return false;
        }

        $this->tags = array_map('strtolower', $this->tags);
        $this->tags = array_map('trim', $this->tags);
        $this->tags = array_filter($this->tags);

        $dbTags = Tag::find()->indexBy(Tag::ATTR_TITLE)->all();

        $transaction = Yii::$app->db->beginTransaction();

        try {
            foreach ($this->tags as $tag) {
                $receiptTag            = new ReceiptTag();
                $receiptTag->receipt_id = $this->receiptId;

                if (array_key_exists($tag, $dbTags)) {
                    $receiptTag->tag_id = $dbTags[$tag]->id;
                }
                else {
                    $dbTag        = new Tag();
                    $dbTag->title = $tag;
                    $dbTag->save();

                    $receiptTag->tag_id = $dbTag->id;
                }

                $receiptTag->save();
            }

            $transaction->commit();
        }
        catch (Exception $e) {
            $transaction->rollBack();
        }

        return true;
    }
}
