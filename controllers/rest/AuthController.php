<?php

namespace app\controllers\rest;

use app\models\Login;
use app\models\SignUp;
use Yii;
use yii\rest\Controller;

class AuthController extends Controller
{
    protected function verbs()
    {
        return [
            'sign-up' => ['post'],
            'login' => ['post']
        ];
    }

    public function actionSignUp()
    {
        $model = new SignUp();
        $model->load(Yii::$app->request->bodyParams, '');
        if($model->validate() && $model->signup()) {
            return [
                'message' => 'Success registration'
            ];
        }
        else {
            return $model;
        }
    }

    public function actionLogin()
    {
        $model = new Login();
        $model->load(Yii::$app->request->bodyParams, '');
        if($model->validate()) {
            $user = $model->getUser();
            $user->access_token = Yii::$app->security->generateRandomString();
            return [
                'access_token' => $user->access_token
            ];
        }
        return $model;
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
