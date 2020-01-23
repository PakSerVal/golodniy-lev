<?php

declare(strict_types=1);

namespace frontend\controllers;

use common\models\Tag;
use frontend\repositories\ReceiptsRepository;
use frontend\services\ReceiptViewRegister;
use yii\data\Pagination;
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

    /** @var ReceiptViewRegister */
    private $receiptViewRegister;

    public function __construct($id, $module, ReceiptsRepository $repository, ReceiptViewRegister $receiptViewRegister, $config = []) {
        $this->repository          = $repository;
        $this->receiptViewRegister = $receiptViewRegister;

        parent::__construct($id, $module, $config);
    }

    /**
     * @param int|null $tag
     *
     * @return mixed
     *
     * @author Pak Sergey
     */
    public function actionIndex(int $tag = null) {
        $totalCount = (null === $tag ? $this->repository->getTotalCount() : $this->repository->getTotalCountByTag($tag));

        $pages = new Pagination(['totalCount' => $totalCount]);

        $pages->setPageSize(3);

        $receipts = (null === $tag ? $this->repository->getAll($pages->limit, $pages->offset) :  $this->repository->getAllByTag($tag, $pages->limit, $pages->offset));

        $tagTitle = null;
        if (null !== $tag) {
            $tagTitle = Tag::find()->select(Tag::ATTR_TITLE)->where([Tag::ATTR_ID => $tag])->scalar();

            if (false === $tagTitle) {
                $tagTitle = null;
            }
        }

        return $this->render($this->action->id, compact('receipts', 'pages', 'tagTitle'));
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

        $this->receiptViewRegister->register($id);

        return $this->render($this->action->id, compact('receipt'));
    }
}
