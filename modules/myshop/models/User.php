<?php

namespace app\modules\myshop\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $name
 * @property string $money
 *
 * @property Inventory[] $inventories
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['money'], 'integer'],
            [['name'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'money' => 'Деньги',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventories()
    {
        return $this->hasMany(Inventory::className(), ['user_id' => 'id']);
    }
}
