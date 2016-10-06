<?php

namespace app\modules\pers\models;

use Yii;

/**
 * This is the model class for table "pers".
 *
 * @property integer $id
 * @property string $name
 * @property integer $lvl
 * @property integer $exp
 * @property string $img
 * @property integer $story_id
 * @property integer $castle_id
 *
 * @property Castle $castle
 * @property Story $story
 * @property PersHasItem[] $persHasItems
 * @property PersHasParam[] $persHasParams
 * @property PersHasSkill[] $persHasSkills
 * @property UserHasPers[] $userHasPers
 */
class Pers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'story_id', 'castle_id'], 'required'],
            [['lvl', 'exp', 'story_id', 'castle_id'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['img'], 'string', 'max' => 255],
          //  [['castle_id'], 'exist', 'skipOnError' => true, 'targetClass' => Castle::className(), 'targetAttribute' => ['castle_id' => 'id']],
          //  [['story_id'], 'exist', 'skipOnError' => true, 'targetClass' => Story::className(), 'targetAttribute' => ['story_id' => 'id']],
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
            'lvl' => 'Lvl',
            'exp' => 'Exp',
            'img' => 'Img',
            'story_id' => 'Story ID',
            'castle_id' => 'Castle ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCastle()
    {
        return $this->hasOne(Castle::className(), ['id' => 'castle_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStory()
    {
        return $this->hasOne(Story::className(), ['id' => 'story_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersHasItems()
    {
        return $this->hasMany(PersHasItem::className(), ['pers_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersHasParams()
    {
        return $this->hasMany(PersHasParam::className(), ['pers_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersHasSkills()
    {
        return $this->hasMany(PersHasSkill::className(), ['pers_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserHasPers()
    {
        return $this->hasMany(UserHasPers::className(), ['pers_id' => 'id']);
    }
}
