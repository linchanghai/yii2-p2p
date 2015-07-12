<?php

namespace core\notification\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use core\notification\models\NotificationTemplate;

/**
 * NotificationTemplateSearch represents the model behind the search form about `core\notification\models\NotificationTemplate`.
 */
class NotificationTemplateSearch extends NotificationTemplate
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['notification_template_id', 'active'], 'integer'],
            [['event', 'type', 'title', 'template', 'receiver'], 'safe'],
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
        $query = NotificationTemplate::find();

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
            'notification_template_id' => $this->notification_template_id,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'event', $this->event])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'template', $this->template])
            ->andFilterWhere(['like', 'receiver', $this->receiver]);

        return $dataProvider;
    }
}
