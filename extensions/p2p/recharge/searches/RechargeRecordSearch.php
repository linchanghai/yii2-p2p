<?php

namespace p2p\recharge\searches;

use kiwi\Kiwi;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use p2p\recharge\models\RechargeRecord;

/**
 * RechargeRecordSearch represents the model behind the search form about `p2p\recharge\models\RechargeRecord`.
 */
class RechargeRecordSearch extends RechargeRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['recharge_record_id', 'member_id', 'use_for_type', 'use_for_id', 'status', 'create_time', 'update_time', 'is_delete'], 'integer'],
            [['transaction_id', 'recharge_type'], 'safe'],
            [['money'], 'number'],
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
        $query = RechargeRecord::find();

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
            'recharge_record_id' => $this->recharge_record_id,
            'member_id' => $this->member_id,
            'money' => $this->money,
            'use_for_type' => $this->use_for_type,
            'use_for_id' => $this->use_for_id,
            'status' => $this->status,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'transaction_id', $this->transaction_id])
            ->andFilterWhere(['like', 'recharge_type', $this->recharge_type]);

        return $dataProvider;
    }

    public function frontendSearch($params)
    {
        $RechargeRecordClass = Kiwi::getRechargeRecordClass();
        $query = $RechargeRecordClass::find()->where([
            'member_id' => Yii::$app->user->id
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 20,
            ]
        ]);

        if ($params) {
            if (isset($params['date'])) {
                switch ($params['date']) {
                    case 1:
                        $query->andWhere(['>=', 'create_time', strtotime('-1 month')]);
                        break;
                    case 2:
                        $query->andWhere(['between', 'create_time', strtotime('-1 month'), strtotime('-3 month')]);
                        break;
                    case 3:
                        $query->andWhere(['between', 'create_time', strtotime('-3 month'), strtotime('-6 month')]);
                        break;
                    case 4:
                        $query->andWhere(['<=', 'create_time', strtotime('-6 month')]);
                        break;
                }
            }
        }

        return $dataProvider;
    }
}
