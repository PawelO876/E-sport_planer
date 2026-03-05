<?php

namespace app\controllers;

use yii\web\Controller;

class StatsController extends Controller
{
    /**
     * Displays statistics dashboard.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
