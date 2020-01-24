<?php

namespace frontend\repositories;

use common\models\Ingredient;
use common\models\Receipt;
use common\models\ReceiptIngredient;
use common\models\ReceiptStep;
use common\models\ReceiptTag;
use common\models\ReceiptViewsCount;
use common\models\Tag;
use DateTime;
use frontend\dto\Receipt as ReceiptDTO;
use frontend\dto\ReceiptIngredient as ReceiptIngredientDTO;
use frontend\dto\ReceiptStep as ReceiptStepDTO;

/**
 * Receipts repository.
 *
 * @author Pak Sergey
 */
class ReceiptsRepository {

    /**
     * Get all receipts.
     *
     * @param int $limit
     * @param int $offset
     *
     * @return ReceiptDTO[]
     *
     * @author Pak Sergey
     */
    public function getAll(int $limit = 20, int $offset = 0): array {
        $receipts = Receipt::find()
            ->limit($limit)
            ->offset($offset)
            ->orderBy([Receipt::ATTR_CREATED_AT => SORT_DESC])
            ->all()
        ;/** @var Receipt[] $receipts */

        $result = [];

        foreach ($receipts as $receipt) {
            $receiptDTO                = new ReceiptDTO();
            $receiptDTO->id            = $receipt->id;
            $receiptDTO->title         = $receipt->title;
            $receiptDTO->description   = $receipt->description;
            $receiptDTO->date          = new DateTime($receipt->created_at);
            $receiptDTO->duration      = $receipt->duration;
            $receiptDTO->portionsCount = $receipt->portions_count;
            $receiptDTO->videoUrl      = $receipt->video_url;
            $receiptDTO->imageUrl      = $receipt->getImageUrl();
            $receiptDTO->steps         = $this->getReceiptSteps($receipt->id);
            $receiptDTO->ingredients   = $this->getReceiptIngredients($receipt->id);
            $receiptDTO->tags          = $this->getReceiptTags($receipt->id);
            $receiptDTO->viewsCount    = $this->getViewsCount($receipt->id);

            $result[] = $receiptDTO;
        }

        return $result;
    }

    /**
     * Получение рецептов по идентификатору тэга.
     *
     * @param int $tagId
     * @param int $limit
     * @param int $offset
     *
     * @return ReceiptDTO[]
     *
     * @author Pak Sergey
     */
    public function getAllByTagId(int $tagId, int $limit = 20, int $offset = 0): array {
        $receipts = Receipt::find()
            ->innerJoin(ReceiptTag::tableName(), ReceiptTag::tableName() . '.' . ReceiptTag::ATTR_RECEIPT_ID . '=' . Receipt::tableName() . '.' . Receipt::ATTR_ID)
            ->where([ReceiptTag::ATTR_TAG_ID => $tagId])
            ->limit($limit)
            ->offset($offset)
            ->all()
        ; /** @var Receipt[] $receipts */

        $result = [];

        foreach ($receipts as $receipt) {
            $receiptDTO                = new ReceiptDTO();
            $receiptDTO->id            = $receipt->id;
            $receiptDTO->title         = $receipt->title;
            $receiptDTO->description   = $receipt->description;
            $receiptDTO->date          = new DateTime($receipt->created_at);
            $receiptDTO->duration      = $receipt->duration;
            $receiptDTO->portionsCount = $receipt->portions_count;
            $receiptDTO->videoUrl      = $receipt->video_url;
            $receiptDTO->imageUrl      = $receipt->getImageUrl();
            $receiptDTO->steps         = $this->getReceiptSteps($receipt->id);
            $receiptDTO->ingredients   = $this->getReceiptIngredients($receipt->id);
            $receiptDTO->tags          = $this->getReceiptTags($receipt->id);
            $receiptDTO->viewsCount    = $this->getViewsCount($receipt->id);

            $result[] = $receiptDTO;
        }

        return $result;
    }

    /**
     * Get by id.
     *
     * @param int $id
     *
     * @return ReceiptDTO|null
     *
     * @author Pak Sergey
     */
    public function getById(int $id): ?ReceiptDTO {
        $source = Receipt::findOne([Receipt::ATTR_ID => $id]);

        if (null === $source) {
            return null;
        }

        $result                = new ReceiptDTO();
        $result->id            = $source->id;
        $result->title         = $source->title;
        $result->description   = $source->description;
        $result->date          = new DateTime($source->created_at);
        $result->imageUrl      = $source->getImageUrl();
        $result->duration      = $source->duration;
        $result->portionsCount = $source->portions_count;
        $result->videoUrl      = $source->video_url;
        $result->steps         = $this->getReceiptSteps($id);
        $result->ingredients   = $this->getReceiptIngredients($id);
        $result->tags          = $this->getReceiptTags($id);
        $result->viewsCount    = $this->getViewsCount($id);

        return $result;
    }

    /**
     * Получение общего количества рецптов.
     *
     * @return int
     *
     * @author Pak Sergey
     */
    public function getTotalCount(): int {
        return Receipt::find()->count();
    }

    /**
     * Получение общего количества рецептов с учетом тэга.
     *
     * @param int $tagId
     *
     * @return int
     *
     * @author Pak Sergey
     */
    public function getTotalCountByTag(int $tagId) {
        return ReceiptTag::find()->where([ReceiptTag::ATTR_TAG_ID => $tagId])->count();
    }

    /**
     * Get tags for receipts.
     *
     * @param string $id Receipt id
     *
     * @return Tag[]
     *
     * @author Pak Sergey
     */
    private function getReceiptTags(string $id): array {
        $tags = Tag::find()
            ->innerJoin(ReceiptTag::tableName(), Tag::tableName() . '.' . Tag::ATTR_ID . '=' . ReceiptTag::tableName() . '.' . ReceiptTag::ATTR_TAG_ID)
            ->where([ReceiptTag::ATTR_RECEIPT_ID => $id])
            ->all()
        ;

        return $tags;
    }

    /**
     * Получение количества просмотров рецепта.
     *
     * @param int $id Идентификатор рецепта
     *
     * @return int
     *
     * @author Pak Sergey
     */
    private function getViewsCount(int $id) {
        $count = ReceiptViewsCount::find()
            ->select(ReceiptViewsCount::ATTR_COUNT)
            ->where([ReceiptViewsCount::ATTR_RECEIPT_ID => $id])
            ->scalar()
        ;

        if (false === $count) {
            $count = 0;
        }

        return $count;
    }

    /**
     * Получение ингредиентов рецепта.
     *
     * @param int $id Идентификатор рецепта
     *
     * @return ReceiptIngredientDTO[]
     *
     * @author Pak Sergey
     */
    private function getReceiptIngredients(int $id): array {
        $result = [];

        $sources = ReceiptIngredient::find()
            ->select([
                ReceiptIngredient::tableName() . '.' . ReceiptIngredient::ATTR_INGREDIENT_ID,
                ReceiptIngredient::tableName() . '.' . ReceiptIngredient::ATTR_COUNT,
                ReceiptIngredient::tableName() . '.' . ReceiptIngredient::ATTR_MEASURE_UNIT,
                Ingredient::tableName()        . '.' . Ingredient::ATTR_TITLE,
            ])
            ->innerJoin(
                Ingredient::tableName(),
                ReceiptIngredient::tableName() . '.' . ReceiptIngredient::ATTR_INGREDIENT_ID . '=' . Ingredient::tableName() . '.' . Ingredient::ATTR_ID
            )
            ->where([ReceiptIngredient::tableName() . '.' . ReceiptIngredient::ATTR_RECEIPT_ID => $id])
            ->asArray()
            ->all()
        ;

        foreach ($sources as $source) {
            $dto              = new ReceiptIngredientDTO();
            $dto->id          = $source[ReceiptIngredient::ATTR_INGREDIENT_ID];
            $dto->title       = $source[Ingredient::ATTR_TITLE];
            $dto->count       = $source[ReceiptIngredient::ATTR_COUNT];
            $dto->measureUnit = $source[ReceiptIngredient::ATTR_MEASURE_UNIT];

            $result[] = $dto;
        }

        return $result;
    }

    /**
     * Получение шагов рецепта.
     *
     * @param int $id Идентификатор рецепта
     *
     * @return ReceiptIngredientDTO[]
     *
     * @author Pak Sergey
     */
    private function getReceiptSteps(int $id): array {
        $result = [];

        $sources = ReceiptStep::find()
            ->where([ReceiptStep::ATTR_RECEIPT_ID => $id])
            ->orderBy(ReceiptStep::ATTR_NUMBER)
            ->all()
        ;

        foreach ($sources as $source) {
            $dto           = new ReceiptStepDTO();
            $dto->id       = $source->id;
            $dto->content  = $source->content;
            $dto->imageUrl = $source->getImageUrl();

            $result[] = $dto;
        }

        return $result;
    }
}
