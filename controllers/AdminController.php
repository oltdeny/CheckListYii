<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class AdminController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['look', 'edit', 'block', 'unblock', 'permit', 'deny'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['look'],
                        'roles' => ['looker'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['look', 'edit'],
                        'roles' => ['editor'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['look', 'block', 'unblock'],
                        'roles' => ['blocker'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['look', 'permit', 'deny'],
                        'roles' => ['permitor'],
                    ],
                ],
            ],
        ];
    }

    public function actionLook()
    {
        $users = User::find()->all();
        return $this->render('users/index', ['users' => $users]);
    }

    public function actionEdit()
    {

    }

    public function actionBlock()
    {

    }

    public function actionUnblock()
    {

    }

    public function actionPermit()
    {

    }

    public function actionDeny()
    {

    }
}