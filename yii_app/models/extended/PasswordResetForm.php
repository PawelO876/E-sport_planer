<?php

namespace app\models\extended;

use Yii;
use yii\base\Model;

/**
 * Password reset form
 */
class PasswordResetForm extends Model
{
    public $password;
    public $password_confirm;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['password', 'password_confirm'], 'required', 'message' => 'To pole jest wymagane'],
            ['password', 'string', 'min' => 6, 'message' => 'Hasło musi mieć minimum 6 znaków'],
            ['password', 'match', 'pattern' => '/^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+\-=\[\]{};:\'",.<>\/?\\|`~]).+$/', 
                'message' => 'Hasło musi zawierać minimum 6 znaków, jedną dużą literę, jedną cyfrę i znak specjalny.'],
            ['password_confirm', 'compare', 'compareAttribute' => 'password', 'message' => 'Hasła muszą być identyczne'],
        ];
    }

    /**
     * Resets password
     *
     * @param string $token
     * @return bool whether the password was reset
     */
    public function resetPassword($token)
    {
        $user = User::findOne(['access_token' => $token]);
        
        if (!$user) {
            $this->addError('password', 'Nieprawidłowy token resetowania hasła');
            return false;
        }

        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->access_token = null;
        
        return $user->save();
    }
}

