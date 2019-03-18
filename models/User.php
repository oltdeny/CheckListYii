<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{

    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['count'], 'integer'],
            [['name', 'email', 'password', 'status'], 'string', 'max' => 255],
            [['email'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'count' => 'Count',
            'status' => 'Status',
        ];
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {

    }

    public function getId()
    {
        return $this->id;
    }

    public function assign($id) {
        $name = Yii::$app->request->post('User');
        $name = $name['name'];
        $role = AuthItem::findOne(['name' => $name]);
        return Yii::$app->authManager->assign($role, $id);
    }

    public function getAuthKey()
    {

    }

    public function validateAuthKey($authKey)
    {

    }

    public function getCheckLists()
    {
        return $this->hasMany(CheckList::className(), ['user_id' => 'id']);

    }
}
