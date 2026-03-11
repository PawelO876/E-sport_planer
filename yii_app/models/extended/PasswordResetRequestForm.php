<?php

namespace app\models\extended;

use Yii;
use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required', 'message' => 'Email jest wymagany'],
            ['email', 'email', 'message' => 'Podaj poprawny adres email'],
            ['email', 'exist', 
                'targetClass' => '\app\models\generated\User', 
                'message' => 'Nie ma konta z tym adresem email'
            ],
        ];
    }

    /**
     * Sends password reset email
     *
     * @return bool whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'email' => $this->email,
        ]);

        if (!$user) {
            return false;
        }
        
        // Generate reset token
        $user->generateAccessToken();
        $user->save(false);

        // Redirect to reset password page with token
        return true;
    }
}

