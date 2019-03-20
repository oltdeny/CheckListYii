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

    public function actionCreate($id) {
        $user = Yii::$app->user->identity;
        $checkList = $user->getCheckLists()->where(['id' => $id])->one();
        if($checkList) {
            $item = new Item();
            $item->load(Yii::$app->request->bodyParams, '');
            $item->checklist_id = $id;
            $item->save();
            return[
                'message' => 'success',
                'item' => $item
            ];
        }
        else {
            return[
                'message' => "unauthorised",
            ];
        }
    }

    public function actionDelete($check_list_id, $item_id) {
        $user = Yii::$app->user->identity;
        $checkList = $user->getCheckLists()->where(['id' => $check_list_id])->one();
        if($checkList && $item = $checkList->getItems()->where(['id' => $item_id])->one()){
            $item->delete();
            return [
                'message' => 'success'
            ];
        }
        else {
            return [
                'message' => 'unauthorised'
            ];
        }
    }

    public function actionUpdate($check_list_id, $item_id) {
        $user = Yii::$app->user->identity;
        $checkList = $user->getCheckLists()->where(['id' => $check_list_id])->one();
        if($checkList && $item = $checkList->getItems()->where(['id' => $item_id])->one()){
            $item->load(Yii::$app->request->bodyParams, '');
            $item->save();
            return [
                'message' => 'success'
            ];
        }
        else {
            return [
                'message' => 'unauthorised'
            ];
        }
    }


}