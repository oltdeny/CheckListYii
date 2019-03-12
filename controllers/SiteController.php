<?php

namespace app\controllers;

use app\models\Login;
use app\models\Signup;
use Yii;
use yii\web\Controller;

class SiteController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSignup()
    {
        $model = new Signup();
        if(Yii::$app->request->post('Signup')) {
            $model->load(Yii::$app->request->post());
            if($model->validate() && $model->signup()) {
                return $this->goHome();
            }
        }
        return $this->render('signup', ['model' => $model]);
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
}
