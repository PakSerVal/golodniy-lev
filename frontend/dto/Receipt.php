<?php

declare(strict_types=1);

namespace frontend\dto;

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

    /** @var string Content */
    public $content;

    /** @var string Image url */
    public $imageUrl;

    /** @var int */
    public $ingredientsCount;

    /** @var int */
    public $duration;

    /** @var Tag[] */
    public $tags = [];
}
