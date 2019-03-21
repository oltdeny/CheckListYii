<?php

namespace app\controllers\rest;

use app\models\Login;
use Yii;
use yii\rest\Controller;

class LoginController extends Controller
{
    protected function verbs()
    {
        return [
            'create' => ['POST'],
        ];
    }

    public function actionCreate()
    {
        $model = new Login();
        $model->load(Yii::$app->request->bodyParams, '');
        if ($model->validate()) {
            $user = $model->getUser();
            if ($user->isActive()) {
                $user->access_token = Yii::$app->security->generateRandomString();
                $user->save();
                return [
                    'access_token' => $user->access_token
                ];
            } else {
                return [
                    'message' => "You are blocked by admin"
                ];
            }

        }
        return $model;
    }
}