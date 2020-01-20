<?php

declare(strict_types=1);

namespace frontend\dto;

/**
 * Receipt step dto.
 *
 * @author Pak Sergey
 */
class ReceiptStep {
    /** @var int Id */
    public $id;

    /** @var string Content */
    public $content;

    /** @var string Image url */
    public $imageUrl;
}
