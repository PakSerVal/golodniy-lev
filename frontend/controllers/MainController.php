<?php

namespace frontend\controllers;

use yii\web\Controller;

class MainController extends Controller {
    public function actionIndex() {
        return $this->render('index');
    }
}
