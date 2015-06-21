<?php

namespace p2p\project\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use p2p\project\models\ProjectRepayment;

/**
 * ProjectRepaymentSearch represents the model behind the search form about `p2p\project\models\ProjectRepayment`.
 */
class ProjectRepaymentSearch extends ProjectRepayment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_repayment_id', 'project_invest_id', 'project_id', 'member_id', 'invest_money', 'repayment_date', 'status', 'is_transfer', 'create_time', 'update_time', 'is_delete'], 'integer'],
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
        $query = ProjectRepayment::find();

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
            'project_repayment_id' => $this->project_repayment_id,
            'project_invest_id' => $this->project_invest_id,
            'project_id' => $this->project_id,
            'member_id' => $this->member_id,
            'interest_money' => $this->interest_money,
            'invest_money' => $this->invest_money,
            'repayment_date' => $this->repayment_date,
            'status' => $this->status,
            'is_transfer' => $this->is_transfer,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'is_delete' => $this->is_delete,
        ]);

        return $dataProvider;
    }
}
