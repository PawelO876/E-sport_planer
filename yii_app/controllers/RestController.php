<?php

namespace app\controllers;

use yii\web\Controller;

class RestController extends Controller
{
    /**
     * Displays rest / recovery overview.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
