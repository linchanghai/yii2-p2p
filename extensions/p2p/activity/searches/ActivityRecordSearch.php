<?php

namespace p2p\activity\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use p2p\activity\models\ActivityRecord;

/**
 * ActivityRecordSearch represents the model behind the search form about `p2p\activity\models\ActivityRecord`.
 */
class ActivityRecordSearch extends ActivityRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_records_id', 'member_id', 'activity_id', 'is_delete'], 'integer'],
            [['note', 'create_time'], 'safe'],
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
        $query = ActivityRecord::find();

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
            'activity_records_id' => $this->activity_records_id,
            'member_id' => $this->member_id,
            'activity_id' => $this->activity_id,
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'create_time', $this->create_time]);

        return $dataProvider;
    }
}
