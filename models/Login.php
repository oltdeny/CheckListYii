<?php
/**
 * Created by PhpStorm.
 * User: danii
 * Date: 12.03.2019
 * Time: 19:14
 */

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
            ['password', 'validatePassword']
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
        Yii::$app->user->login($this->getUser());
    }
}