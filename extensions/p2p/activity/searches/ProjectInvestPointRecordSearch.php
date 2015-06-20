<?php

namespace p2p\activity\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use p2p\activity\models\ProjectInvestPointRecord;

/**
 * ProjectInvestPointRecordSearch represents the model behind the search form about `p2p\activity\models\ProjectInvestPointRecord`.
 */
class ProjectInvestPointRecordSearch extends ProjectInvestPointRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_invest_point_record', 'project_invest_record_id', 'project_id', 'member_id', 'point', 'project_type', 'create_time', 'is_delete'], 'integer'],
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
        $query = ProjectInvestPointRecord::find();

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
            'project_invest_point_record' => $this->project_invest_point_record,
            'project_invest_record_id' => $this->project_invest_record_id,
            'project_id' => $this->project_id,
            'member_id' => $this->member_id,
            'point' => $this->point,
            'project_type' => $this->project_type,
            'create_time' => $this->create_time,
            'is_delete' => $this->is_delete,
        ]);

        return $dataProvider;
    }
}
