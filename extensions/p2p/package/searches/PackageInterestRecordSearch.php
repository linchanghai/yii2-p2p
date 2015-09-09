<?php

namespace p2p\package\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use p2p\package\models\PackageInterestRecord;

/**
 * PackageInterestRecordSearch represents the model behind the search form about `p2p\package\models\PackageInterestRecord`.
 */
class PackageInterestRecordSearch extends PackageInterestRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['package_interest_record_id', 'member_id', 'create_time', 'is_delete'], 'integer'],
            [['daily_interest'], 'number'],
            [['target_date'], 'safe'],
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
        $query = PackageInterestRecord::find();

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
            'package_interest_record_id' => $this->package_interest_record_id,
            'member_id' => $this->member_id,
            'daily_interest' => $this->daily_interest,
            'create_time' => $this->create_time,
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'target_date', $this->target_date]);

        return $dataProvider;
    }
}
