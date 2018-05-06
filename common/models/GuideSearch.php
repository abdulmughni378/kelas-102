<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Guide;

/**
 * GuideSearch represents the model behind the search form about `common\models\Guide`.
 */
class GuideSearch extends Guide
{

    public $pagesize;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['guide_id', 'guide_category_guide_category_id', 'pagesize'], 'integer'],
            [['guide_date', 'guide_date_gmt', 'guide_post', 'guide_title', 'guide_excerpt', 'guide_status', 'guide_comments', 'guide_type', 'guide_mime_type', 'comment_count', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
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
        $query = Guide::find()->orderBy(['created_at' => SORT_DESC]);

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
            'guide_id' => $this->guide_id,
            'guide_category_guide_category_id' => $this->guide_category_guide_category_id,
        ]);

        $query->andFilterWhere(['like', 'guide_date', $this->guide_date])
            ->andFilterWhere(['like', 'guide_date_gmt', $this->guide_date_gmt])
            ->andFilterWhere(['like', 'guide_post', $this->guide_post])
            ->andFilterWhere(['like', 'guide_title', $this->guide_title])
            ->andFilterWhere(['like', 'guide_excerpt', $this->guide_excerpt])
            ->andFilterWhere(['like', 'guide_status', $this->guide_status])
            ->andFilterWhere(['like', 'guide_comments', $this->guide_comments])
            ->andFilterWhere(['like', 'guide_type', $this->guide_type])
            ->andFilterWhere(['like', 'guide_mime_type', $this->guide_mime_type])
            ->andFilterWhere(['like', 'comment_count', $this->comment_count])
            ->andFilterWhere(['like', 'DATE(created_at)', $this->created_at])
            // ->andFilterWhere(['like', 'DATE_FORMAT(created_at, "%m/%d/%Y")', str_replace('%2F', '-', $this->created_at) ])            
            ->andFilterWhere(['like', 'updated_at', $this->updated_at])
            ->andFilterWhere(['like', 'deleted_at', $this->deleted_at]);

        return $dataProvider;
    }
}
