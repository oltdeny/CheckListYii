<?php

namespace app\models;


use Yii;
use yii\base\Model;

class Login extends Model
{
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword()
    {
        $user = $this->getUser();
        if(!$user || ($user->password != sha1($this->password))) {
            $this->addError('Пароль или имя пользователя неверны');
        }
    }

    public function getUser()
    {
        return User::findOne(['email' => $this->email]);
    }

    public function login()
    {
        return Yii::$app->user->login($this->getUser());
    }
}