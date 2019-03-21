<?php

namespace app\controllers\rest;

use app\models\SignUp;
use Yii;
use yii\rest\Controller;

class RegisterController extends Controller
{
    protected function verbs()
    {
        return [
            'create' => ['POST'],
        ];
    }

    public function actionCreate()
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
}