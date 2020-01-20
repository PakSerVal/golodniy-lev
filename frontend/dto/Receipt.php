<?php

declare(strict_types=1);

namespace frontend\dto;

use common\models\Tag;

/**
 * Receipt dto.
 *
 * @author Pak Sergey
 */
class Receipt {
    /** @var int Id */
    public $id;

    /** @var string Title */
    public $title;

    /** @var string Description */
    public $description;

    /** @var string Image url */
    public $imageUrl;

    /** @var ReceiptIngredient[] */
    public $ingredients;

    /** @var ReceiptStep[] */
    public $steps;

    /** @var int */
    public $duration;

    /** @var string */
    public $videoUrl;

    /** @var Tag[] */
    public $tags = [];
}
