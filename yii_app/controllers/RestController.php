<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\extended\Rest;

class RestController extends Controller
{
    /**
     * Displays rest / recovery overview and handles simple create form.
     *
     * @return string\yii\web\Response
     */
    public function actionIndex()
    {
        // Require user to be logged in
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }
        
        $model = new Rest();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->id;

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Dane zapisane.');
                return $this->refresh();
            }
        }

        $userId = Yii::$app->user->id;
        $restList = Rest::find()
            ->where(['user_id' => $userId])
            ->orderBy(['date' => SORT_DESC])
            ->all();

        return $this->render('index', [
            'model' => $model,
            'restList' => $restList,
        ]);
    }
}
