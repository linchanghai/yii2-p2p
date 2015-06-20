<?php

namespace p2p\activity\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use p2p\activity\models\ProjectLegalOpinion;

/**
 * ProjectLegalOpinionSearch represents the model behind the search form about `p2p\activity\models\ProjectLegalOpinion`.
 */
class ProjectLegalOpinionSearch extends ProjectLegalOpinion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_legal_opinion_id', 'project_id', 'create_time', 'update_time', 'is_delete'], 'integer'],
            [['legal_info'], 'safe'],
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
        $query = ProjectLegalOpinion::find();

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
            'project_legal_opinion_id' => $this->project_legal_opinion_id,
            'project_id' => $this->project_id,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'legal_info', $this->legal_info]);

        return $dataProvider;
    }
}
