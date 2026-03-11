<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use app\models\extended\User;
use app\models\extended\Message;

/**
 * AdminController - handles admin-only actions
 */
class AdminController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'messages', 'users', 'delete-message', 'delete-user', 'mark-message-read'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Check if user is admin, otherwise throw 403
     */
    protected function checkAdmin()
    {
        if (!Yii::$app->user->identity->isAdmin()) {
            throw new \yii\web\ForbiddenHttpException('Dostęp tylko dla administratora.');
        }
    }

    /**
     * Admin dashboard
     * @return string
     */
    public function actionIndex()
    {
        $this->checkAdmin();
        
        $userCount = User::find()->count();
        $messageCount = Message::find()->count();
        $unreadMessageCount = Message::find()->where(['is_read' => false])->count();
        
        return $this->render('index', [
            'userCount' => $userCount,
            'messageCount' => $messageCount,
            'unreadMessageCount' => $unreadMessageCount,
        ]);
    }

    /**
     * List all messages
     * @return string
     */
    public function actionMessages()
    {
        $this->checkAdmin();
        
        $messages = Message::find()->orderBy(['created_at' => SORT_DESC])->all();
        
        return $this->render('messages', [
            'messages' => $messages,
        ]);
    }

    /**
     * Delete a message
     * @param int $id
     * @return Response
     */
    public function actionDeleteMessage($id)
    {
        $this->checkAdmin();
        
        $message = Message::findOne($id);
        if ($message !== null) {
            $message->delete();
            Yii::$app->session->setFlash('success', 'Wiadomość została usunięta.');
        }
        
        return $this->redirect(['messages']);
    }

    /**
     * Mark message as read
     * @param int $id
     * @return Response
     */
    public function actionMarkMessageRead($id)
    {
        $this->checkAdmin();
        
        $message = Message::findOne($id);
        if ($message !== null) {
            $message->is_read = true;
            $message->save(false);
        }
        
        return $this->redirect(['messages']);
    }

    /**
     * List all users
     * @return string
     */
    public function actionUsers()
    {
        $this->checkAdmin();
        
        $users = User::find()->all();
        
        return $this->render('users', [
            'users' => $users,
        ]);
    }

    /**
     * Delete a user
     * @param int $id
     * @return Response
     */
    public function actionDeleteUser($id)
    {
        $this->checkAdmin();
        
        // Prevent admin from deleting themselves
        if ($id == Yii::$app->user->id) {
            Yii::$app->session->setFlash('error', 'Nie możesz usunąć swojego konta.');
            return $this->redirect(['users']);
        }
        
        $user = User::findOne($id);
        if ($user !== null) {
            $user->delete();
            Yii::$app->session->setFlash('success', 'Użytkownik został usunięty.');
        }
        
        return $this->redirect(['users']);
    }
}

