<?php

namespace p2p\activity\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use p2p\activity\models\ProductMap;

/**
 * ProductMapSearch represents the model behind the search form about `p2p\activity\models\ProductMap`.
 */
class ProductMapSearch extends ProductMap
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_map_id', 'type', 'exchange_points', 'duration', 'create_time', 'update_time', 'is_delete'], 'integer'],
            [['exchange_value'], 'safe'],
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
        $query = ProductMap::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'product_map_id' => $this->product_map_id,
            'type' => $this->type,
            'exchange_points' => $this->exchange_points,
            'duration' => $this->duration,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'exchange_value', $this->exchange_value]);

        return $dataProvider;
    }
}
