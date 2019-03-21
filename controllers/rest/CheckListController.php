<?php

namespace app\controllers\rest;

use app\models\CheckList;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\VerbFilter;
use yii\rest\Controller;


class CheckListController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
        ];
        return $behaviors;
    }

    public function actionIndex()
    {
        $user = Yii::$app->user->identity;
        $checkLists = $user->getCheckLists()->all();
        return [
            'checkLists' => $checkLists
        ];
    }

    public function actionCreate()
    {
        $user = Yii::$app->user->identity;
        $count = $user->getCheckLists()->count();
        $max_count = $user->count;
        if ($count < $max_count) {
            $checkList = new CheckList();
            $checkList->load(Yii::$app->request->bodyParams, '');
            $checkList->user_id = Yii::$app->user->id;
            $checkList->save();
            return [
                'message' => 'success',
                'checkList' => $checkList
            ];
        }
        return [
            'message' => "You couldn't create more then $max_count check-lists",
        ];
    }

    public function actionView($id)
    {
        $user = Yii::$app->user->identity;
        $checkList = $user->getCheckLists()->where(['id' => $id])->one();
        if ($checkList) {
            return [
                'message' => 'success',
                'checkList' => $checkList
            ];
        }
        return [
            'message' => 'unauthorised'
        ];
    }

    public function actionDelete($id)
    {
        $user = Yii::$app->user->identity;
        $checkList = $user->getCheckLists()->where(['id' => $id])->one();
        if ($checkList) {
            $checkList->delete();
            return [
                'message' => 'success'
            ];
        }
        return [
            'message' => 'unauthorised'
        ];
    }
}