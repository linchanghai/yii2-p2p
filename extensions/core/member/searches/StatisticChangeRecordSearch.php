<?php

namespace core\member\searches;

use Yii;
use yii\base\Model;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;
use core\member\models\StatisticChangeRecord;

/**
 * StatisticChangeRecordSearch represents the model behind the search form about `core\member\models\StatisticChangeRecord`.
 */
class StatisticChangeRecordSearch extends StatisticChangeRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['statistic_change_record_id', 'member_id', 'type', 'link_id', 'create_time', 'is_delete'], 'integer'],
            [['attribute', 'note'], 'safe'],
            [['value', 'result'], 'number'],
        ];
    }

    public function behaviors()
    {
        return [
            'time' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => false,
            ],
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
        $query = static::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'statistic_change_record_id' => $this->statistic_change_record_id,
            'member_id' => $this->member_id,
            'type' => $this->type,
            'value' => $this->value,
            'result' => $this->result,
            'link_id' => $this->link_id,
            'create_time' => $this->create_time,
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'attribute', $this->attribute])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }

    public function frontendSearch($params)
    {
        $query = static::find();

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
                        $query->andWhere(['>=', 'create_time', strtotime('-2 month')]);
                        break;
                    case 3:
                        $query->andWhere(['>=', 'create_time', strtotime('-3 month')]);
                        break;
                }
            }

            if (isset($params['type'])) {
                switch ($params['type']) {
                    case 'recharge':
                        $query->andWhere(['type' => static::TYPE_RECHARGE]);
                        break;
                    case 'withdraw':
                        $query->andWhere(['type' => static::TYPE_WITHDRAW_SUCCESS]);
                        break;
                    case 'invest':
                        $query->andWhere(['type' => static::TYPE_PACKAGE_INTEREST]);
                        break;
                    case 'repayment':
                        $query->andWhere(['type' => static::TYPE_REPAYMENT]);
                        break;
                    case 'transfer':
                        $query->andWhere(['type' => static::TYPE_INVEST]);
                        break;
                }
            }
        }

        return $dataProvider;
    }
}
