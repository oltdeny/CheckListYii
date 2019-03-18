<?php

namespace app\controllers;

use app\models\Login;
use app\models\SignUp;
use Yii;
use yii\web\Controller;

class SiteController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSignUp()
    {
        $model = new SignUp();
        if(Yii::$app->request->post('SignUp')) {
            $model->load(Yii::$app->request->post());
            if($model->validate() && $model->signup()) {
                return $this->goHome();
            }
        }
        return $this->render('sign-up', ['model' => $model]);
    }

    public function actionLogin()
    {
        $model = new Login();
        if(Yii::$app->request->post('Login')) {
            $model->load(Yii::$app->request->post());
            if($model->validate() && $model->login()) {
                return $this->goHome();
            }
        }
        return $this->render('login', ['model' => $model]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
