<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace p2p\project\forms;


use kiwi\base\Model;
use kiwi\Kiwi;
use Yii;

/**
 * Class InvestForm
 * @package p2p\project\forms
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class InvestForm extends Model
{
    const EVENT_BEFORE_INVEST = 'beforeInvest';
    const EVENT_AFTER_INVEST = 'afterInvest';

    public $money;
    /** @var int the project to invest */
    public $project_id;
    /** @var int the annual member coupon to be used */
    public $annual_id;

    /** @var \p2p\project\models\Project */
    protected $project;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'money'], 'required'],
            ['project_id', 'validateProject'],
            ['money', 'validateMoney'],
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

    /**
     * validate if the project exist and the project status is investing
     */
    public function validateProject()
    {
        $projectClass = Kiwi::getProjectClass();
        $this->project = $projectClass::findOne($this->project_id);
        if (!$this->project || $this->project->status != $projectClass::STATUS_INVESTING) {
            $this->addError('project_id', 'Invalid Project ID');
        }
    }

    public function validateMoney()
    {
        if ($this->hasErrors('project_id')) {
            return false;
        }

        /** @var \yii\validators\NumberValidator $numberValidator */
        $numberValidator = Yii::createObject([
            'class' => 'yii\validators\NumberValidator',
            'integerOnly' => true,
            'min' => $this->project->min_money,
            'max' => $this->project->invest_total_money - $this->project->invested_money,
        ]);

        $numberValidator->validateAttribute($this, 'money');

    }

    public function invest()
    {
        $invest = Kiwi::getProjectInvest();
        $invest->member_id = Yii::$app->user->id;
        $invest->project_id = $this->project_id;
        $invest->invest_money = $this->money;
        $invest->save();
    }
} 