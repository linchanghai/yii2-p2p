<?php

namespace p2p\activity\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use p2p\activity\models\ExchangeRecord;

/**
 * ExchangeRecordSearch represents the model behind the search form about `p2p\activity\models\ExchangeRecord`.
 */
class ExchangeRecordSearch extends ExchangeRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exchange_records_id', 'member_id', 'product_map_id', 'quantity', 'create_time', 'is_delete'], 'integer'],
            [['note'], 'safe'],
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
        $query = ExchangeRecord::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

//        if (!$this->validate()) {
//            // uncomment the following line if you do not want to return any records when validation fails
//            // $query->where('0=1');
//            return $dataProvider;
//        }

        $query->andFilterWhere([
            'exchange_records_id' => $this->exchange_records_id,
            'member_id' => $this->member_id,
            'product_map_id' => $this->product_map_id,
            'quantity' => $this->quantity,
            'create_time' => $this->create_time,
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
