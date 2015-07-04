<?php

namespace p2p\activity\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use p2p\activity\models\CouponAnnualRecord;

/**
 * CouponAnnualRecordSearch represents the model behind the search form about `p2p\activity\models\CouponAnnualRecord`.
 */
class CouponAnnualRecordSearch extends CouponAnnualRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['coupon_annual_record_id', 'project_invest_id', 'project_id', 'member_id', 'member_coupon_id', 'create_time', 'is_delete'], 'integer'],
            [['rate', 'interst_money'], 'number'],
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
        $query = CouponAnnualRecord::find();

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
            'coupon_annual_record_id' => $this->coupon_annual_record_id,
            'project_invest_id' => $this->project_invest_id,
            'project_id' => $this->project_id,
            'member_id' => $this->member_id,
            'member_coupon_id' => $this->member_coupon_id,
            'rate' => $this->rate,
            'interst_money' => $this->interst_money,
            'create_time' => $this->create_time,
            'is_delete' => $this->is_delete,
        ]);

        return $dataProvider;
    }
}
