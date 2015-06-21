<?php

namespace core\member\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use core\member\models\Member;

/**
 * MemberSearch represents the model behind the search form about `core\member\models\Member`.
 */
class MemberSearch extends Member
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'status', 'create_time', 'update_time', 'is_deleted'], 'integer'],
            [['username', 'password_hash', 'mobile', 'email', 'email_vaild_code', 'real_name', 'id_card', 'recomend_user', 'recomend_type'], 'safe'],
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
        $query = Member::find();

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
            'member_id' => $this->member_id,
            'status' => $this->status,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'is_deleted' => $this->is_deleted,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'email_vaild_code', $this->email_vaild_code])
            ->andFilterWhere(['like', 'real_name', $this->real_name])
            ->andFilterWhere(['like', 'id_card', $this->id_card])
            ->andFilterWhere(['like', 'recomend_user', $this->recomend_user])
            ->andFilterWhere(['like', 'recomend_type', $this->recomend_type]);

        return $dataProvider;
    }
}
