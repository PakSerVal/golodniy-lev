<?php

namespace frontend\controllers;

use common\helpers\validators\IntValValidator;
use common\models\Tag;
use frontend\repositories\ReceiptsRepository;
use Yii;
use yii\data\Pagination;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

/**
 * Поиск.
 *
 * @author Pak Sergey
 */
class SearchController extends Controller {

    /** @var ReceiptsRepository */
    private $receiptsRepository;

    /**
     * @inheritDoc
     *
     * @author Pak Sergey
     */
    public function __construct($id, $module, ReceiptsRepository $receiptsRepository, $config = []) {
        $this->receiptsRepository = $receiptsRepository;

        parent::__construct($id, $module, $config);
    }

    /**
     * Поиск.
     *
     * @param string|int $q
     *
     * @return mixed
     */
    public function actionIndex($q) {
        $receipts = [];

        $tag      = null;
        $tagId    = null;
        $tagTitle = $q;
        if (false === (bool)preg_match('/^\d+$/', $q)) {
            if (strlen($q) < 60) {
                $tag = Tag::findOne([Tag::ATTR_TITLE => $q]);
            }
        }
        else {
            $tag = Tag::findOne([Tag::ATTR_ID => $q]);
        }

        if (null !== $tag) {
            $tagId    = $tag->id;
            $tagTitle = $tag->title;
        }

        $totalCount = (null === $tagId ? 0 : $this->receiptsRepository->getTotalCountByTag($tagId));
        $pages      = new Pagination(['totalCount' => $totalCount]);

        if (null !== $tagId) {
            $receipts = $this->receiptsRepository->getAllByTagId($tagId, $pages->limit, $pages->offset);
        }

        return $this->render($this->action->id, compact('receipts', 'pages', 'tagTitle'));
    }
}
