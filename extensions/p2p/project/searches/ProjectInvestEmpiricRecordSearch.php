<?php

namespace p2p\project\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use p2p\project\models\ProjectInvestEmpiricRecord;

/**
 * ProjectInvestEmpiricRecordSearch represents the model behind the search form about `p2p\project\models\ProjectInvestEmpiricRecord`.
 */
class ProjectInvestEmpiricRecordSearch extends ProjectInvestEmpiricRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_invest_empiric_id', 'project_invest_id', 'project_id', 'member_id', 'empiric_value', 'create_time', 'is_delete'], 'integer'],
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
        $query = ProjectInvestEmpiricRecord::find();

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
            'project_invest_empiric_id' => $this->project_invest_empiric_id,
            'project_invest_id' => $this->project_invest_id,
            'project_id' => $this->project_id,
            'member_id' => $this->member_id,
            'empiric_value' => $this->empiric_value,
            'create_time' => $this->create_time,
            'is_delete' => $this->is_delete,
        ]);

        return $dataProvider;
    }
}
