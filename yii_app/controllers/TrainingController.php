<?php

namespace app\controllers;

use yii\web\Controller;

class TrainingController extends Controller
{
    /**
     * Displays list of trainings or dashboard for trainings.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
