<?php

namespace app\controllers;

use app\models\User;

class CheckListController extends \yii\web\Controller
{
    public function actionIndex($id)
    {
        $checklists = User::findOne($id)->getCheckLists()->all();
        return $this->render('index', ['checklists' => $checklists]);
    }

    public function actionView()
    {
        return $this->render('view');
    }

}
