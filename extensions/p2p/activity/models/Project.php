<?php

namespace p2p\activity\models;

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
 */
class Project extends \kiwi\db\ActiveRecord
{
    use ProjectTrait;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_name', 'project_no', 'invest_total_money', 'interest_rate', 'repayment_date', 'repayment_type', 'release_date', 'project_type', 'min_money'], 'required'],
            [['verify_date', 'invest_total_money', 'repayment_date', 'repayment_type', 'release_date', 'invested_money', 'min_money', 'status'], 'integer'],
            [['interest_rate'], 'number'],
            [['verify_user'], 'string'],
            [['project_name'], 'string', 'max' => 100],
            [['project_no'], 'string', 'max' => 30],
            [['project_type'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_id' => Yii::t('p2p_activity', 'Project ID'),
            'project_name' => Yii::t('p2p_activity', 'Project Name'),
            'project_no' => Yii::t('p2p_activity', 'Project No'),
            'invest_total_money' => Yii::t('p2p_activity', 'Invest Total Money'),
            'interest_rate' => Yii::t('p2p_activity', 'Interest Rate'),
            'repayment_date' => Yii::t('p2p_activity', 'Repayment Date'),
            'repayment_type' => Yii::t('p2p_activity', 'Repayment Type'),
            'release_date' => Yii::t('p2p_activity', 'Release Date'),
            'project_type' => Yii::t('p2p_activity', 'Project Type'),
            'create_user' => Yii::t('p2p_activity', 'Create User'),
            'invested_money' => Yii::t('p2p_activity', 'Invested Money'),
            'verify_user' => Yii::t('p2p_activity', 'Verify User'),
            'verify_date' => Yii::t('p2p_activity', 'Verify Date'),
            'min_money' => Yii::t('p2p_activity', 'Min Money'),
            'status' => Yii::t('p2p_activity', 'Status'),
            'create_time' => Yii::t('p2p_activity', 'Create Time'),
            'update_time' => Yii::t('p2p_activity', 'Update Time'),
            'is_delete' => Yii::t('p2p_activity', 'Is Delete'),
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


}
