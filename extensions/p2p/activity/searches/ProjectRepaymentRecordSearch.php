<?php

namespace p2p\activity\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use p2p\activity\models\ProjectRepaymentRecord;

/**
 * ProjectRepaymentRecordSearch represents the model behind the search form about `p2p\activity\models\ProjectRepaymentRecord`.
 */
class ProjectRepaymentRecordSearch extends ProjectRepaymentRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_repayment_record', 'project_invest_record_id', 'project_id', 'member_id', 'invest_money', 'repayment_date', 'status', 'create_time', 'update_time', 'is_delete'], 'integer'],
            [['interest_money'], 'number'],
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
        $query = ProjectRepaymentRecord::find();

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
            'project_repayment_record' => $this->project_repayment_record,
            'project_invest_record_id' => $this->project_invest_record_id,
            'project_id' => $this->project_id,
            'member_id' => $this->member_id,
            'interest_money' => $this->interest_money,
            'invest_money' => $this->invest_money,
            'repayment_date' => $this->repayment_date,
            'status' => $this->status,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'is_delete' => $this->is_delete,
        ]);

        return $dataProvider;
    }
}
