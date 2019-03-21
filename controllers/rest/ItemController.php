<?php

namespace app\controllers\rest;

use app\models\CheckList;
use app\models\Item;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;


class ItemController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
        ];
        return $behaviors;
    }

    public function actionCreate()
    {
        $user = Yii::$app->user->identity;
        $id = Yii::$app->request->post('check_list_id');
        $checkList = $user->getCheckLists()->where(['id' => $id])->one();
        if ($checkList) {
            $item = new Item();
            $item->load(Yii::$app->request->bodyParams, '');
            $item->checklist_id = $id;
            $item->save();
            return [
                'message' => 'success',
                'item' => $item
            ];
        }
        return [
            'message' => "unauthorised",
        ];
    }

    public function actionDelete($id)
    {
        $user = Yii::$app->user->identity;
        $item = Item::findOne($id);
        if ($item) {
            $checkList = $item->getChecklist()->one();
            $checkList = $user->getCheckLists()->where(['id' => $checkList->id])->one();
            if ($checkList) {
                $item->delete();
                return [
                    'message' => 'success'
                ];
            }
        }
        return [
            'message' => 'unauthorised'
        ];
    }

    public function actionUpdate($id)
    {
        $user = Yii::$app->user->identity;
        $item = Item::findOne($id);
        if ($item) {
            $checkList = $item->getChecklist()->one();
            $checkList = $user->getCheckLists()->where(['id' => $checkList->id])->one();
            if ($checkList) {
                if ($item->status === 'todo') {
                    $item->status = 'done';
                } else {
                    $item->status = 'todo';
                }
                $item->save();
                return [
                    'message' => 'success'
                ];
            }
        }
        return [
            'message' => 'unauthorised'
        ];
    }


}