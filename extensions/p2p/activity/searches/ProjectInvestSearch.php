<?php

namespace p2p\activity\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use p2p\activity\models\ProjectInvest;

/**
 * ProjectInvestSearch represents the model behind the search form about `p2p\activity\models\ProjectInvest`.
 */
class ProjectInvestSearch extends ProjectInvest
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_invest_id', 'project_id', 'member_id', 'invest_money', 'create_time', 'update_time', 'status', 'is_delete', 'actual_invest_money'], 'integer'],
            [['rate', 'interest_money'], 'number'],
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
        $query = ProjectInvest::find();

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
            'project_invest_id' => $this->project_invest_id,
            'project_id' => $this->project_id,
            'member_id' => $this->member_id,
            'rate' => $this->rate,
            'invest_money' => $this->invest_money,
            'interest_money' => $this->interest_money,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'status' => $this->status,
            'is_delete' => $this->is_delete,
            'actual_invest_money' => $this->actual_invest_money,
        ]);

        return $dataProvider;
    }
}
