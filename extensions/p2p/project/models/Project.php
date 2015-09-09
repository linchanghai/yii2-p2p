<?php

namespace p2p\project\models;

use kiwi\Kiwi;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "project".
 *
 * @property integer $project_id
 * @property string $project_name
 * @property string $project_no
 * @property integer $invest_total_money
 * @property string $interest_rate
 * @property integer $repayment_date
 * @property integer $repayment_type
 * @property integer $release_date
 * @property string $project_type
 * @property string $create_user
 * @property integer $invested_money
 * @property string $verify_user
 * @property integer $verify_date
 * @property integer $min_money
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $is_delete
 *
 * @property ProjectInvest[] $projectInvests
 */
class Project extends \kiwi\db\ActiveRecord
{
    use ProjectTrait;

    const TYPE_NORMAL = 0;
    const TYPE_TRANSFER = 1;

    const TYPE_NOVICE = 2;
    const STATUS_PENDING = 0;
    const STATUS_INVESTING = 1;
    const STATUS_FAILED = 2;
    const STATUS_REPAYMENT = 3;
    const STATUS_END = 4;

    const REPAYMENT_TYPE_MONTHLY = 0;
    const REPAYMENT_TYPE_ONETIME = 1;
    const REPAYMENT_TYPE_EQUAL_MONTHLY = 2;

    public static $enableLogicDelete = true;

    public static $enableCascadeDelete = true;

    public static $cascadeDeleteRelations = ['ProjectDetails', 'ProjectLegalOpinion', 'ProjectMaterial'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
    }

    public function scenarios()
    {
        return [
            static::SCENARIO_DEFAULT => ['project_name', 'project_no', 'invest_total_money', 'interest_rate', 'repayment_date', 'repayment_type', 'release_date', 'project_type', 'min_money', 'status'],
            'insert' => ['project_name', 'project_no', 'invest_total_money', 'interest_rate', 'repayment_date', 'repayment_type', 'release_date', 'project_type', 'min_money'],
            'check' => ['status']
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_name', 'project_no', 'invest_total_money', 'interest_rate', 'repayment_date', 'repayment_type', 'release_date', 'project_type', 'min_money'], 'required'],
            [['project_name', 'project_no'], 'unique'],
            [['invest_total_money', 'repayment_type', 'invested_money', 'min_money', 'status', 'project_type'], 'integer'],
            [['interest_rate'], 'number'],
//            [['verify_user'], 'string'],
            [['project_name'], 'string', 'max' => 100],
            [['project_no'], 'string', 'max' => 30],
            ['repayment_date', 'date', 'format' => 'yyyy-MM-dd', 'timestampAttribute' => 'repayment_date', 'on' => ['insert']],
            ['release_date', 'date', 'format' => 'yyyy-MM-dd', 'timestampAttribute' => 'release_date', 'on' => ['insert']],
            [['repayment_date', 'release_date'], 'validateDate', 'on' => ['insert']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_id' => Yii::t('p2p_project', 'Project ID'),
            'project_name' => Yii::t('p2p_project', 'Project Name'),
            'project_no' => Yii::t('p2p_project', 'Project No'),
            'invest_total_money' => Yii::t('p2p_project', 'Invest Total Money'),
            'interest_rate' => Yii::t('p2p_project', 'Interest Rate'),
            'repayment_date' => Yii::t('p2p_project', 'Repayment Date'),
            'repayment_type' => Yii::t('p2p_project', 'Repayment Type'),
            'release_date' => Yii::t('p2p_project', 'Release Date'),
            'project_type' => Yii::t('p2p_project', 'Project Type'),
            'create_user' => Yii::t('p2p_project', 'Create User'),
            'invested_money' => Yii::t('p2p_project', 'Invested Money'),
            'verify_user' => Yii::t('p2p_project', 'Verify User'),
            'verify_date' => Yii::t('p2p_project', 'Verify Date'),
            'min_money' => Yii::t('p2p_project', 'Min Money'),
            'status' => Yii::t('p2p_project', 'Status'),
            'create_time' => Yii::t('p2p_project', 'Create Time'),
            'update_time' => Yii::t('p2p_project', 'Update Time'),
            'is_delete' => Yii::t('p2p_project', 'Is Delete'),
        ];
    }

    public function behaviors()
    {
        return [
            'time' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => 'update_time',
            ],
            'user' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'create_user',
                'updatedByAttribute' => false,
            ]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectInvests()
    {
        return $this->hasMany(Kiwi::getProjectInvestClass(), ['project_id' => 'project_id']);
    }

    public function validateDate()
    {
        if ($this->repayment_date < strtotime(date('Y-m-d',strtotime('+1 day')))) {
            $this->addError('repayment_date', 'repayment_date不能早于当前时间！');
        }
        if ($this->release_date < strtotime(date('Y-m-d',strtotime('+1 day')))) {
            $this->addError('release_date', 'release_date不能早于当前时间！');
        }
    }

    public function canTransfer()
    {
        if ($this->create_time < strtotime('-1 month')) {
            return true;
        }
        return false;
    }
}
