<?php

namespace core\cms\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use core\cms\models\CmsNotice;

/**
 * CmsNoticeSearch represents the model behind the search form about `core\cms\models\CmsNotice`.
 */
class CmsNoticeSearch extends CmsNotice
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cms_notice_id', 'type', 'create_time', 'update_time', 'publihser_date', 'is_delete'], 'integer'],
            [['img', 'title', 'content', 'create_by', 'update_by'], 'safe'],
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
        $query = CmsNotice::find();

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
            'cms_notice_id' => $this->cms_notice_id,
            'type' => $this->type,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'publihser_date' => $this->publihser_date,
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'img', $this->img])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'create_by', $this->create_by])
            ->andFilterWhere(['like', 'update_by', $this->update_by]);

        return $dataProvider;
    }
}
