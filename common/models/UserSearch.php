<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class UserSearch extends User
{
    public $pagesize;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['users_id', 'gender', 'pagesize'], 'integer'],
            [['full_name', 'birth_date', 'email', 'username', 'password', 'password_reset_token', 'phone_number', 'activation_token', 'activation_date', 'auth_key', 'token_fb', 'token_g', 'user_url', 'picture', 'logged_last_time', 'user_token', 'status', 'created_date', 'updated_date', 'is_type'], 'safe'],
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
        $query = User::find()->orderBy(['created_date' => SORT_DESC]);

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
            'users_id' => $this->users_id,
            'gender' => $this->gender,
            'birth_date' => $this->birth_date,
            'activation_date' => $this->activation_date,
            'logged_last_time' => $this->logged_last_time,
            'created_date' => $this->created_date,
            'updated_date' => $this->updated_date,
        ]);

        $query->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'activation_token', $this->activation_token])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'token_fb', $this->token_fb])
            ->andFilterWhere(['like', 'token_g', $this->token_g])
            ->andFilterWhere(['like', 'user_url', $this->user_url])
            ->andFilterWhere(['like', 'picture', $this->picture])
            ->andFilterWhere(['like', 'user_token', $this->user_token])
            ->andFilterWhere(['like', 'is_type', $this->is_type])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
