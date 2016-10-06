<?php

namespace app\modules\pers\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\pers\models\Pers;

/**
 * PersSearch represents the model behind the search form about `app\modules\pers\models\Pers`.
 */
class PersSearch extends Pers
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lvl', 'exp', 'story_id', 'castle_id'], 'integer'],
            [['name', 'img'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Pers::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'lvl' => $this->lvl,
            'exp' => $this->exp,
            'story_id' => $this->story_id,
            'castle_id' => $this->castle_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'img', $this->img]);

        return $dataProvider;
    }
}
