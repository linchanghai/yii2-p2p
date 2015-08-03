<?php

namespace p2p\transfer\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use p2p\transfer\models\ProjectInvestTransferApply;

/**
 * ProjectInvestTransferApplySearch represents the model behind the search form about `p2p\transfer\models\ProjectInvestTransferApply`.
 */
class ProjectInvestTransferApplySearch extends ProjectInvestTransferApply
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_invest_transfer_apply_id', 'project_invest_id', 'project_id', 'member_id', 'min_money', 'total_invest_money', 'status', 'verify_date', 'create_time', 'update_time', 'is_delete'], 'integer'],
            [['discount_rate', 'counter_fee'], 'number'],
            [['verify_user'], 'safe'],
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
        $query = ProjectInvestTransferApply::find();

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
            'project_invest_transfer_apply_id' => $this->project_invest_transfer_apply_id,
            'project_invest_id' => $this->project_invest_id,
            'project_id' => $this->project_id,
            'member_id' => $this->member_id,
            'min_money' => $this->min_money,
            'total_invest_money' => $this->total_invest_money,
            'discount_rate' => $this->discount_rate,
            'status' => $this->status,
            'verify_date' => $this->verify_date,
            'counter_fee' => $this->counter_fee,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'verify_user', $this->verify_user]);

        return $dataProvider;
    }
}
