<?php

declare(strict_types=1);

namespace frontend\widgets;

use frontend\repositories\ReceiptsRepository;
use yii\base\Widget;

/**
 * Main page receipts widget.
 *
 * @author Pak Sergey
 */
class MainPageReceipts extends Widget {

    /** @var ReceiptsRepository */
    protected $repository;

    /**
     * @inheritDoc
     *
     * @author Pak Sergey
     */
    public function __construct(ReceiptsRepository $repository, $config = []) {
        $this->repository = $repository;

        parent::__construct($config);
    }

    /**
     * @inheritDoc
     *
     * @author Pak Sergey
     */
    public function run() {
        $receipts = $this->repository->getAll(12);

        if (count($receipts) === 0) {
            return '';
        }

        return $this->render('main-page-receipts', compact('receipts'));
    }
}
