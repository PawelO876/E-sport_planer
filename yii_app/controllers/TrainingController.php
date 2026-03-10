<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\extended\Training;

class TrainingController extends Controller
{
    /**
     * Lists all Training models.
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
        // Require user to be logged in
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }
        
        $userId = Yii::$app->user->id;
        $trainingList = Training::find()
            ->where(['user_id' => $userId])
            ->orderBy(['date' => SORT_DESC])
            ->all();

        return $this->render('index', [
            'trainingList' => $trainingList,
        ]);
    }

    /**
     * Creates a new Training model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        // Require user to be logged in
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }
        
        $training = new Training();

        if ($training->load(Yii::$app->request->post()) && $training->validate()) {
         
            $training->user_id = Yii::$app->user->id;
            
            $training->save();

            Yii::$app->session->setFlash('success', 'Trening został dodany!');

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'training' => $training
        ]);
    }

}
