<?php

declare(strict_types=1);

namespace frontend\dto;

/**
 * Дто ингредиента рецепта.
 *
 * @author Pak Sergey
 */
class ReceiptIngredient {
    /** @var int Идентификатор */
    public $id;

    /** @var string Заголовок */
    public $title;

    /** @var string Количество */
    public $count;

    /** @var string Единица измерения */
    public $measureUnit;
}
