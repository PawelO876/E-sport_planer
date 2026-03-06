<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Training;

class TrainingController extends Controller
{
    /**
     * Lists all Training models.
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
        $trainingList = Training::find()->orderBy(['date' => SORT_DESC])->all();

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
        $training = new Training();

        if ($training->load(Yii::$app->request->post()) && $training->validate()) {
         
            $training->user_id = Yii::$app->user->id ?? 1;
            
            $training->save();

            Yii::$app->session->setFlash('success', 'Training created');

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'training' => $training
        ]);
    }

}
