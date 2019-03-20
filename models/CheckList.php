<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "checklist".
 *
 * @property int $id
 * @property string $name
 * @property int $user_id
 *
 * @property User $user
 * @property Item[] $items
 */
class CheckList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'checklist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function fields()
    {
        return [
            'id' => 'id',
            'name' => 'name',
            'user_id' => 'user_id',
            'items' => function() {
                return $this->getItems()->all();
            }
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['checklist_id' => 'id']);
    }
}
