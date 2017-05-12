<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Contributor;

/**
 * ContributorSearch represents the model behind the search form of `app\models\contributor`.
 */
class ContributorSearch extends contributor
{
    /**
     * @inheritdoc
     */
    public function attributes()
    {
        // add related fields to searchable attributes
      return array_merge(parent::attributes(), ['role.role','country.country','location.location']);

    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'telephone', 'role_id', 'country_id', 'active'], 'integer'],
            [['username', 'password', 'email', 'organization', 'date', 'role.role', 'country.country','location.location'], 'safe'],
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
        $query = contributor::find();

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

        $dataProvider->sort->attributes['role.role'] = [
            'asc' => ['role.role' => SORT_ASC],
            'desc' => ['role.role' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['country.country'] = [
            'asc' => ['country.country' => SORT_ASC],
            'desc' => ['country.country' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['location.location'] = [
            'asc' => ['location.location' => SORT_ASC],
            'desc' => ['location.location' => SORT_DESC],
        ];

        $query->joinWith(['role','country','location']);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'telephone' => $this->telephone,
            'role_id' => $this->role_id,
            'country_id' => $this->country_id,
            'date' => $this->date,
            'contributor.active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'organization', $this->organization]);

        $query->andFilterWhere(['LIKE', 'country.country', $this->getAttribute('country.country')])
            ->andFilterWhere(['LIKE', 'location.location', $this->getAttribute('location.location')])
            ->andFilterWhere(['LIKE', 'role.role', $this->getAttribute('role.role')]);

        return $dataProvider;
    }
}
