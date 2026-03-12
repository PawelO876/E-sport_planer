<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\extended\Training;
use app\models\extended\Rest;

class StatsController extends Controller
{
    /**
     * Displays statistics dashboard.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }

        $userId = Yii::$app->user->id;
        $trainingCount = Training::find()->where(['user_id' => $userId])->count();
        $totalMinutes = Training::find()->where(['user_id' => $userId])->sum('duration');
        $restCount = Rest::find()->where(['user_id' => $userId])->count();

        return $this->render('index', [
            'trainingCount' => $trainingCount,
            'totalMinutes' => $totalMinutes,
            'restCount' => $restCount,
        ]);
    }
}
