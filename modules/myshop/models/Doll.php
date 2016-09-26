<?php

namespace app\modules\myshop\models;

use Yii;

/**
 * This is the model class for table "doll".
 *
 * @property string $id
 * @property integer $user_id
 * @property string $item_id
 * @property string $part
 *
 * @property Item $item
 * @property User $user
 */
class Doll extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doll';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'item_id', 'part'], 'required'],
            [['user_id', 'item_id'], 'integer'],
            [['part'], 'string', 'max' => 128],
            [['user_id', 'item_id', 'part'], 'unique', 'targetAttribute' => ['user_id', 'item_id', 'part'], 'message' => 'The combination of User ID, Item ID and Part has already been taken.'],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'item_id' => 'Item ID',
            'part' => 'Part',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
