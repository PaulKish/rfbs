<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\volume;

/**
 * VolumeSearch represents the model behind the search form of `app\models\volume`.
 */
class VolumeSearch extends volume
{
    /**
     * @inheritdoc
     */
    public function attributes()
    {
        // add related fields to searchable attributes
      return array_merge(parent::attributes(), ['product.commodity','user.organization','type.type','user.country.country']);

    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'product_id', 'type_id', 'active'], 'integer'],
            [['volume'], 'number'],
            [['date', 'time','product.commodity','user.organization','type.type','user.country.country','pagesize'], 'safe'],
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
        $query = volume::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => isset($params['pagesize']) ? $params['pagesize']:20,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith(['product','user','type','user.country']); // join with country table from user relation 

        $dataProvider->sort->attributes['product.commodity'] = [
            'asc' => ['commodity.commodity' => SORT_ASC],
            'desc' => ['commodity.commodity' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['user.organization'] = [
            'asc' => ['contributor.organization' => SORT_ASC],
            'desc' => ['contributor.organization' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['type.type'] = [
            'asc' => ['type.type' => SORT_ASC],
            'desc' => ['type.type' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['user.country.country'] = [
            'asc' => ['country.country' => SORT_ASC],
            'desc' => ['country.country' => SORT_DESC],
        ];

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'product_id' => $this->product_id,
            'volume' => $this->volume,
            'type_id' => $this->type_id,
            'date' => $this->date,
            'time' => $this->time,
            'volume.active' => $this->active,
        ])
        ->andFilterWhere(['LIKE', 'commodity.commodity', $this->getAttribute('product.commodity')])
        ->andFilterWhere(['LIKE', 'type.type', $this->getAttribute('type.type')])
        ->andFilterWhere(['LIKE', 'country.country', $this->getAttribute('user.country.country')])
        ->andFilterWhere(['LIKE', 'contributor.organization', $this->getAttribute('user.organization')]);

        return $dataProvider;
    }
}
