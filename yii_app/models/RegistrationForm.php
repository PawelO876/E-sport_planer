<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * RegistrationForm is the model for user registration.
 *
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $password_repeat
 */
class RegistrationForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_repeat;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password', 'password_repeat'], 'required'],
            [['username', 'email', 'password'], 'string', 'max' => 255],
            [['username'], 'string', 'min' => 3],
            [['password'], 'string', 'min' => 6],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => User::class, 'targetAttribute' => 'email'],
            [['username'], 'unique', 'targetClass' => User::class, 'targetAttribute' => 'username'],
            [['password_repeat'], 'compare', 'compareAttribute' => 'password', 'message' => "Hasła nie są identyczne."],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Nazwa użytkownika',
            'email' => 'Adres e-mail',
            'password' => 'Hasło',
            'password_repeat' => 'Powtórz hasło',
        ];
    }

    /**
     * Registers a new user.
     * @return bool whether the user was registered successfully
     */
    public function register()
    {
        if (!$this->validate()) {
            return false;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);  // Fixed: Use setPassword to hash the password
        $user->generateAuthKey();

        return $user->save();
    }
}

