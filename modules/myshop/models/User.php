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
class User extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['money'], 'integer'],
            [['name'], 'string', 'max' => 20],
            [['item_list'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'money' => 'Деньги',
        ];
    }

    public function getItems() {
        return $this->hasMany(Item::className(), ['id' => 'item_id'])
                        ->viaTable('inventory', ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventories() {
        return $this->hasMany(Inventory::className(), ['user_id' => 'id']);
    }

    public function behaviors() {
        return [
            [
                'class' => \voskobovich\behaviors\ManyToManyBehavior::className(),
                'relations' => [
                    'item_list' => 'items',
                ],
            ],
        ];
    }

}
