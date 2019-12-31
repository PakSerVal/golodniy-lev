<?php

namespace frontend\repositories;

use common\models\Receipt;
use frontend\dto\Receipt as ReceiptDTO;
use frontend\dto\Tag;

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
     *
     * @return ReceiptDTO[]
     *
     * @author Pak Sergey
     */
    public function getAll(int $limit = 20): array {
        $receipts = Receipt::find()
            ->limit(20)
            ->orderBy(Receipt::ATTR_CREATED_AT)
            ->all()
        ;/** @var Receipt[] $receipts */

        $result = [];

        foreach ($receipts as $receipt) {
            $receiptDTO                   = new ReceiptDTO();
            $receiptDTO->id               = $receipt->id;
            $receiptDTO->title            = $receipt->title;
            $receiptDTO->content          = $receipt->content;
            $receiptDTO->imageUrl         = $receipt->getImageUrl();
            $receiptDTO->ingredientsCount = 10; //todo-25.12.19-pak.s
            $receiptDTO->duration         = 10; //todo-25.12.19-pak.s
            $receiptDTO->tags             = $this->getReceiptTags($receipt->id);

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

        $result                   = new ReceiptDTO();
        $result->id               = $source->id;
        $result->title            = $source->title;
        $result->content          = $source->content;
        $result->imageUrl         = $source->getImageUrl();
        $result->ingredientsCount = 10; //todo-25.12.19-pak.s
        $result->duration         = 10; //todo-25.12.19-pak.s
        $result->tags             = $this->getReceiptTags($id);

        return $result;
    }

    /**
     * Get tags for receipts.
     *
     * @param string $id Receipt id
     *
     * @return Tag[]
     * todo-25.12.19-pak.s
     * @author Pak Sergey
     */
    protected function getReceiptTags(string $id): array {
        $result = [];

        for ($i = 0; $i < rand(1, 5); $i++) {
            $tag        = new Tag();
            $tag->id    = 1;
            $tag->title = 'tag' . ' ' . rand(1, 100);
            $tag->url   = '/';

            $result[] = $tag;
        }

        return $result;
    }
}
