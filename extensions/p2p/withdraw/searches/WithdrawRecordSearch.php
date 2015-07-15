<?php

namespace p2p\withdraw\searches;

use kiwi\Kiwi;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use p2p\withdraw\models\WithdrawRecord;

/**
 * WithdrawRecordSearch represents the model behind the search form about `p2p\withdraw\models\WithdrawRecord`.
 */
class WithdrawRecordSearch extends WithdrawRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['deposit_record_id', 'member_id', 'first_verify_date', 'second_verify_date', 'status', 'create_time', 'update_time', 'is_delete'], 'integer'],
            [['money', 'counter_fee'], 'number'],
            [['deposit_type', 'first_verify_user', 'second_verify_user'], 'safe'],
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
        $withdrawClass = Kiwi::getWithdrawRecordClass();
        $query = $withdrawClass::find();

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
            'deposit_record_id' => $this->deposit_record_id,
            'member_id' => $this->member_id,
            'money' => $this->money,
            'counter_fee' => $this->counter_fee,
            'first_verify_date' => $this->first_verify_date,
            'second_verify_date' => $this->second_verify_date,
            'status' => $this->status,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'deposit_type', $this->deposit_type])
            ->andFilterWhere(['like', 'first_verify_user', $this->first_verify_user])
            ->andFilterWhere(['like', 'second_verify_user', $this->second_verify_user]);

        return $dataProvider;
    }
}
