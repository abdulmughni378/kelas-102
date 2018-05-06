<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\GuideCategory;

/**
 * GuideCategorySearch represents the model behind the search form about `common\models\GuideCategory`.
 */
class GuideCategorySearch extends GuideCategory
{
    public $pagesize;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['guide_category_id', 'guide_category_parent', 'pagesize'], 'integer'],
            [['guide_category_name'], 'safe'],
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
        $query = GuideCategory::find()->orderBy(['created_date' => SORT_DESC]);

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
            'guide_category_id' => $this->guide_category_id,
            'guide_category_parent' => $this->guide_category_parent,
        ]);

        $query->andFilterWhere(['like', 'guide_category_name', $this->guide_category_name]);

        return $dataProvider;
    }
}
