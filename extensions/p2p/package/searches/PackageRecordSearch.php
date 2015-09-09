<?php

namespace p2p\package\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use p2p\package\models\PackageRecord;

/**
 * PackageRecordSearch represents the model behind the search form about `p2p\package\models\PackageRecord`.
 */
class PackageRecordSearch extends PackageRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['package_record_id', 'member_id', 'exchange_cash', 'type', 'create_time', 'is_delete'], 'integer'],
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
        $query = PackageRecord::find();

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
            'package_record_id' => $this->package_record_id,
            'member_id' => $this->member_id,
            'exchange_cash' => $this->exchange_cash,
            'type' => $this->type,
            'create_time' => $this->create_time,
            'is_delete' => $this->is_delete,
        ]);

        return $dataProvider;
    }
}
