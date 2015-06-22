<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/6/22
 * Time: 11:25
 */

namespace p2p\project\forms;

use kiwi\Kiwi;
use Yii;
use kiwi\base\Model;

class ProjectInvestPrepareForm extends Model
{
    public $money;
    public $annual_id;
    public $project_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['money','project_id'], 'required'],
            [['annual_id'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'money' => Yii::t('p2p_project', 'Money'),
            'project_id' => Yii::t('p2p_project', 'Project'),
            'annual_id' => Yii::t('p2p_project', 'Annual'),
        ];
    }

    public function calculateInvest()
    {
        /** @var \p2p\project\models\Project $project */
        $project = Kiwi::getProject()->findOne($this->project_id);
        $invest = Kiwi::getProjectInvest();
        $invest->project_id = $project->project_id;
        $invest->member_id = Yii::$app->user->id;
        $invest->rate = $project->interest_rate;
        $invest->invest_money = $this->money;

        $repayemnts= [];


        $invest->interest_money = null;

        $invest->setRelation('projectRepayments', $repayemnts);
        return $invest;
        return [$invest, $repayemnts];
    }
}