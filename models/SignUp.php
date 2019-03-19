<?php

namespace app\models;

use Symfony\Component\Yaml\Yaml;
use Yii;
use yii\base\Model;

class SignUp extends Model
{
    public $name;
    public $email;
    public $password;

    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
        ];
    }

    public function rules()
    {
        return [
            [['name', 'email', 'password'], 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => 'app\models\User'],
            ['password', 'string', 'min' => 3, 'max' => 10],
        ];
    }

    public function signUp()
    {
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = sha1($this->password);
        return $user->save();
    }
}