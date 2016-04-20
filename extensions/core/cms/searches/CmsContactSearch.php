<?php

namespace core\cms\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use core\cms\models\CmsContact;

/**
 * CmsContactSearch represents the model behind the search form about `core\cms\models\CmsContact`.
 */
class CmsContactSearch extends CmsContact
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cms_contact_id', 'create_time', 'update_time', 'is_delete'], 'integer'],
            [['address', 'phone', 'qq', 'weibo', 'weixin', 'create_by', 'update_by'], 'safe'],
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
        $query = CmsContact::find();

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
            'cms_contact_id' => $this->cms_contact_id,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'qq', $this->qq])
            ->andFilterWhere(['like', 'weibo', $this->weibo])
            ->andFilterWhere(['like', 'weixin', $this->weixin])
            ->andFilterWhere(['like', 'create_by', $this->create_by])
            ->andFilterWhere(['like', 'update_by', $this->update_by]);

        return $dataProvider;
    }
}
