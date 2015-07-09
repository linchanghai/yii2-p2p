<?php

namespace p2p\project\searches;

use kiwi\Kiwi;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use p2p\project\models\Project;

/**
 * ProjectSearch represents the model behind the search form about `p2p\project\models\Project`.
 */
class ProjectSearch extends Project
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'invest_total_money', 'repayment_date', 'repayment_type', 'release_date', 'invested_money', 'verify_date', 'min_money', 'status', 'create_time', 'update_time', 'is_delete'], 'integer'],
            [['project_name', 'project_no', 'project_type', 'create_user', 'verify_user'], 'safe'],
            [['interest_rate'], 'number'],
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
        $projectClass = Kiwi::getProjectClass();
        $query = $projectClass::find();

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
            'project_id' => $this->project_id,
            'invest_total_money' => $this->invest_total_money,
            'interest_rate' => $this->interest_rate,
            'repayment_date' => $this->repayment_date,
            'repayment_type' => $this->repayment_type,
            'release_date' => $this->release_date,
            'invested_money' => $this->invested_money,
            'verify_date' => $this->verify_date,
            'min_money' => $this->min_money,
            'status' => $this->status,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'project_name', $this->project_name])
            ->andFilterWhere(['like', 'project_no', $this->project_no])
            ->andFilterWhere(['like', 'project_type', $this->project_type])
            ->andFilterWhere(['like', 'create_user', $this->create_user])
            ->andFilterWhere(['like', 'verify_user', $this->verify_user]);

        return $dataProvider;
    }
    public function frontendSearch($params)
    {
        $projectClass = Kiwi::getProjectClass();
        $query = $projectClass::find()->where([
            'status' => $projectClass::STATUS_INVESTING,
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => '2',
         ]
        ]);

       if($params){
           if(isset($params['rate'])){
               switch($params['rate']){
                   case 9:
                       $query->andWhere(['<=', 'interest_rate',9]);
                       break;
                   case 10:
                       $query->andWhere(['between', 'interest_rate',9,13]);
                       break;
                   case 13:
                       $query->andWhere(['>=', 'interest_rate',13]);
                       break;
               }
           }
           if(isset($params['date'])){
               switch($params['date']){
                   case 1:
                       $query->andWhere(['<=', 'repayment_date',time()+30* 3600 * 24]);
                       break;
                   case 2:
                       $query->andWhere(['between', 'repayment_date',time()+30* 3600 * 24,time()+3*30* 3600 * 24]);
                       break;
                   case 3:
                       $query->andWhere(['between', 'repayment_date',time()+3*30* 3600 * 24,time()+6*30* 3600 * 24]);
                       break;
                   case 4:
                       $query->andWhere(['>=', 'repayment_date',time()+6*30* 3600 * 24]);
                       break;
               }
           }
       }



        return $dataProvider;
    }
}
