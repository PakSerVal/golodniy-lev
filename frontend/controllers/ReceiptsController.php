<?php

declare(strict_types=1);

namespace frontend\controllers;

use frontend\repositories\ReceiptsRepository;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

/**
 * Receipts controller.
 *
 * @author Pak Sergey
 */
class ReceiptsController extends Controller {

    /** @var ReceiptsRepository */
    private $repository;

    public function __construct($id, $module, ReceiptsRepository $repository, $config = []) {
        $this->repository = $repository;

        parent::__construct($id, $module, $config);
    }

    /**
     * @return mixed
     *
     * @author Pak Sergey
     */
    public function actionIndex() {
        $receipts = $this->repository->getAll();

        return $this->render($this->action->id, compact('receipts'));
    }

    /**
     * @param int $id
     *
     * @return mixed
     *
     * @author Pak Sergey
     */
    public function actionView(int $id) {
        $receipt = $this->repository->getById($id);

        if (null === $receipt) {
            throw new BadRequestHttpException('Неверные данные запроса');
        }

        return $this->render($this->action->id, compact('receipt'));
    }
}
