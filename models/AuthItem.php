<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class AuthItem extends ActiveRecord
{

    public static function tableName()
    {
        return 'auth_item';
    }


    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'type' => 'Type',
            'description' => 'Description',
            'rule_name' => 'Rule Name',
            'data' => 'Data',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function isChecked($id)
    {
        $role = AuthAssignment::find()->where([
            'item_name' => $this->name,
            'user_id' => $id
        ])->count();
        return $role > 0 ? true : false;
    }

    public function getChildren()
    {
        return $this->hasMany(AuthItem::className(), ['name' => 'child'])->viaTable('auth_item_child',
            ['parent' => 'name']);
    }

    public function getParents()
    {
        return $this->hasMany(AuthItem::className(), ['name' => 'parent'])->viaTable('auth_item_child',
            ['child' => 'name']);
    }
}
