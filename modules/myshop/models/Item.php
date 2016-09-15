<?php

namespace app\modules\myshop\models;

use Yii;

/**
 * This is the model class for table "item".
 *
 * @property string $id
 * @property string $name
 * @property string $img
 * @property string $cost
 *
 * @property Assorty[] $assorties
 * @property Inventory[] $inventories
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['cost'], 'integer'],
            [['name', 'img'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'img' => 'Img',
            'cost' => 'Cost',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssorties()
    {
        return $this->hasMany(Assorty::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventories()
    {
        return $this->hasMany(Inventory::className(), ['item_id' => 'id']);
    }
}
