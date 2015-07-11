<?php

namespace core\member\models;

use kiwi\behaviors\ChangeBehavior;
use kiwi\Kiwi;
use Yii;
use yii\base\Exception;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%statistic_change_record}}".
 *
 * @property integer $statistic_change_record_id
 * @property integer $member_id
 * @property integer $type
 * @property integer $attribute
 * @property string $value
 * @property string $result
 * @property integer $link_id
 * @property string $note
 * @property integer $create_time
 * @property integer $is_delete
 */
class StatisticChangeRecord extends \kiwi\db\ActiveRecord
{
    const TYPE_RECHARGE = 1;
    const TYPE_INVEST = 2;
    const TYPE_REPAYMENT = 14;
    const TYPE_ACCOUNT_TO_PACKAGE = 3;
    const TYPE_PACKAGE_TO_ACCOUNT = 4;
    const TYPE_PACKAGE_INTEREST = 5;
    const TYPE_WITHDRAW_APPLY = 6;
    const TYPE_WITHDRAW_FORBIDDEN = 7;
    const TYPE_WITHDRAW_SUCCESS = 8;
    const TYPE_WITHDRAW_FAIL = 9;

    const TYPE_INVEST_EMPIRICAL = 11;
    const TYPE_USER_POINT_REGISTER = 12;

    const TYPE_EXCHANGE_POINT = 21;
    const TYPE_ACTIVITY_POINT = 22;

    public $types = [];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%statistic_change_record}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['note', 'default', 'value' => ''],
            [ 'link_id', 'default', 'value' => 0],
            [['type', 'value'], 'required'],
            [['type', 'link_id'], 'integer'],
            [['value', 'result'], 'number'],
            [['attribute'], 'string', 'max' => 40],
            [['note'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'statistic_change_record_id' => Yii::t('core_member', 'Statistic Change Record ID'),
            'member_id' => Yii::t('core_member', 'Member ID'),
            'attribute' => Yii::t('core_member', 'Attribute'),
            'type' => Yii::t('core_member', 'Type'),
            'value' => Yii::t('core_member', 'Value'),
            'result' => Yii::t('core_member', 'Result'),
            'link_id' => Yii::t('core_member', 'Link ID'),
            'note' => Yii::t('core_member', 'Note'),
            'create_time' => Yii::t('core_member', 'Create Time'),
            'is_delete' => Yii::t('core_member', 'Is Delete'),
        ];
    }

    public function behaviors()
    {
        return [
            'changeLog' => $this->getChangeBehavior(),
            'time' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => false,
            ],
        ];
    }

    public function getChangeBehavior()
    {
        $types = [
            static::TYPE_ACCOUNT_TO_PACKAGE => [
                'targetClass' => Kiwi::getMemberStatisticClass(),
                'attribute' => $this->attribute,
                'condition' => ['member_id' => $this->member_id],
            ],
            static::TYPE_PACKAGE_TO_ACCOUNT => [
                'targetClass' => Kiwi::getMemberStatisticClass(),
                'attribute' => $this->attribute,
                'condition' => ['member_id' => $this->member_id],
            ],
            static::TYPE_RECHARGE => [
                'targetClass' => Kiwi::getMemberStatisticClass(),
                'attribute' => 'account_money',
                'condition' => ['member_id' => $this->member_id],
            ],
            static::TYPE_INVEST_EMPIRICAL => [
                'targetClass' => Kiwi::getMemberStatisticClass(),
                'attribute' => 'empirical_value',
                'condition' => ['member_id' => $this->member_id],
            ],
            static::TYPE_EXCHANGE_POINT => [
                'targetClass' => Kiwi::getMemberStatisticClass(),
                'attribute' => 'points',
                'condition' => ['member_id' => $this->member_id],
            ],
            static::TYPE_ACTIVITY_POINT => [
                'targetClass' => Kiwi::getMemberStatisticClass(),
                'attribute' => 'points',
                'condition' => ['member_id' => $this->member_id],
            ],
            static::TYPE_INVEST => [
                'targetClass' => Kiwi::getMemberStatisticClass(),
                'attribute' => 'account_money',
                'condition' => ['member_id' => $this->member_id],
            ],
            static::TYPE_REPAYMENT => [
                'targetClass' => Kiwi::getMemberStatisticClass(),
                'attribute' => 'account_money',
                'condition' => ['member_id' => $this->member_id],
            ],
        ];

        $types = ArrayHelper::merge($types, $this->types);

        if (empty($types[$this->type])) {
            throw new Exception('Invalid Type: ' . $this->type);
        }

        $config = $types[$this->type];
        $config['class'] = ChangeBehavior::className();

        $this->attribute = $config['attribute'];

        return $config;
    }
}
