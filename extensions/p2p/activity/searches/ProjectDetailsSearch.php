<?php

namespace p2p\activity\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use p2p\activity\models\ProjectDetails;

/**
 * ProjectDetailsSearch represents the model behind the search form about `p2p\activity\models\ProjectDetails`.
 */
class ProjectDetailsSearch extends ProjectDetails
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_details_id', 'project_id', 'create_time', 'update_time', 'is_delete'], 'integer'],
            [['project_introduce', 'loan_person_info', 'repayment_source', 'collateral_info', 'risk_control_info'], 'safe'],
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
        $query = ProjectDetails::find();

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
            'project_details_id' => $this->project_details_id,
            'project_id' => $this->project_id,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'project_introduce', $this->project_introduce])
            ->andFilterWhere(['like', 'loan_person_info', $this->loan_person_info])
            ->andFilterWhere(['like', 'repayment_source', $this->repayment_source])
            ->andFilterWhere(['like', 'collateral_info', $this->collateral_info])
            ->andFilterWhere(['like', 'risk_control_info', $this->risk_control_info]);

        return $dataProvider;
    }
}
