<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\extended\LoginForm;
use app\models\extended\RegistrationForm;
use app\models\extended\ContactForm;
use app\models\extended\PasswordResetRequestForm;
use app\models\extended\PasswordResetForm;
use app\models\extended\Message;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'my-messages', 'update-message', 'delete-message'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['my-messages', 'update-message', 'delete-message'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                    'delete-message' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Register action.
     *
     * @return Response|string
     */
    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegistrationForm();
        
        if ($model->load(Yii::$app->request->post())) {
            $user = new \app\models\extended\User();
            $user->username = $model->username;
            $user->email = $model->email;
            $user->role = \app\models\extended\User::ROLE_USER;
            $user->setPassword($model->password);
            $user->generateAuthKey();
            
            if ($user->save()) {
                Yii::$app->session->setFlash('success', 'Konto zostało utworzone. Możesz się teraz zalogować.');
                return $this->redirect(['login']);
            } else {
                Yii::$app->session->setFlash('error', 'Nie udało się utworzyć konta. Spróbuj ponownie.');
            }
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post())) {
            // Save message to database
            $model->saveMessage();
            
            // Send email notification
            if ($model->contact(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('contactFormSubmitted');

                return $this->refresh();
            }
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Requests password reset.
     *
     * @return Response|string
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->sendEmail()) {
                // Find user and get token, then redirect
                $user = \app\models\extended\User::findOne(['email' => $model->email]);
                if ($user) {
                    return $this->redirect(['site/reset-password', 'token' => $user->access_token]);
                }
            } else {
                Yii::$app->session->setFlash('error', 'Nie znaleziono konta z tym adresem email.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return Response|string
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new PasswordResetForm();
        } catch (\Exception $e) {
            throw new \yii\web\BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->resetPassword($token)) {
            Yii::$app->session->setFlash('success', 'Hasło zostało zmienione. Możesz się teraz zalogować.');
            return $this->redirect(['login']);
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Lists user's messages.
     *
     * @return string
     */
    public function actionMyMessages()
    {
        $messages = Message::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();

        return $this->render('myMessages', [
            'messages' => $messages,
        ]);
    }

    /**
     * Updates user's message.
     *
     * @param int $id
     * @return Response|string
     */
    public function actionUpdateMessage($id)
    {
        $message = Message::findOne(['id' => $id, 'user_id' => Yii::$app->user->id]);
        
        if (!$message) {
            Yii::$app->session->setFlash('error', 'Wiadomość nie została znaleziona.');
            return $this->redirect(['my-messages']);
        }

        if ($message->load(Yii::$app->request->post())) {
            if ($message->save()) {
                Yii::$app->session->setFlash('success', 'Wiadomość została zaktualizowana.');
                return $this->redirect(['my-messages']);
            }
        }

        return $this->render('updateMessage', [
            'model' => $message,
        ]);
    }

    /**
     * Deletes user's message.
     *
     * @param int $id
     * @return Response
     */
    public function actionDeleteMessage($id)
    {
        $message = Message::findOne(['id' => $id, 'user_id' => Yii::$app->user->id]);
        
        if ($message) {
            $message->delete();
            Yii::$app->session->setFlash('success', 'Wiadomość została usunięta.');
        } else {
            Yii::$app->session->setFlash('error', 'Wiadomość nie została znaleziona.');
        }

        return $this->redirect(['my-messages']);
    }
}
