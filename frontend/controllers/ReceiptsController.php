<?php

declare(strict_types=1);

namespace frontend\controllers;

use common\models\Tag;
use frontend\repositories\ReceiptsRepository;
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

    public function __construct($id, $module, ReceiptsRepository $repository, $config = []) {
        $this->repository = $repository;

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

        return $this->render($this->action->id, compact('receipt'));
    }
}
