<?php

namespace frontend\controllers;

use common\models\Media;
use yii\web\Controller;

class MainController extends Controller {
    public function actionIndex() {
        $youtubeViewsCount   = Media::find()->select(Media::ATTR_COUNT)->where([Media::ATTR_ID => Media::MEDIA_YOUTUBE_ID])->scalar();
        $instagramSubsCount = Media::find()->select(Media::ATTR_COUNT)->where([Media::ATTR_ID => Media::MEDIA_INSTAGRAM_ID])->scalar();

        return $this->render('index', compact('youtubeViewsCount', 'instagramSubsCount'));
    }
}
