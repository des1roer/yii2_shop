<?php

namespace app\modules\myshop\models;

use Yii;

/**
 * This is the model class for table "shop".
 *
 * @property string $id
 * @property string $name
 *
 * @property Assorty[] $assorties
 */
class Shop extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'shop';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name'], 'required'],
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
            'name' => 'Название',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssorties() {
        return $this->hasMany(Assorty::className(), ['shop_id' => 'id']);
    }

    public function getItems() {
        return $this->hasMany(Item::className(), ['id' => 'item_id'])
                        ->viaTable('assorty', ['shop_id' => 'id']);
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
