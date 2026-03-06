<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Rest;

class RestController extends Controller
{
    /**
     * Displays rest / recovery overview and handles simple create form.
     *
     * @return string\yii\web\Response
     */
    public function actionIndex()
    {
        $model = new Rest();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->id ?? 1;

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Dane zapisane.');
                return $this->refresh();
            }
        }

        $restList = Rest::find()->orderBy(['date' => SORT_DESC])->all();

        return $this->render('index', [
            'model' => $model,
            'restList' => $restList,
        ]);
    }
}
