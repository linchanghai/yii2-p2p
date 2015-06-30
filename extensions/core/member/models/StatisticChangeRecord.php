<?php

namespace core\member\models;

use kiwi\behaviors\ChangeLogBehavior;
use kiwi\Kiwi;
use Yii;
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
    const TYPE_ACCOUNT_TO_PACKAGE = 3;
    const TYPE_PACKAGE_TO_ACCOUNT = 4;
    const TYPE_PACKAGE_INTEREST = 5;
    const TYPE_WITHDRAW_APPLY = 6;
    const TYPE_WITHDRAW_FORBIDDEN = 7;
    const TYPE_WITHDRAW_SUCCESS = 8;
    const TYPE_WITHDRAW_FAIL = 9;

    const TYPE_INVEST_EMPIRICAL = 11;
    const TYPE_USER_POINT_REGISTER = 12;

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
            [['member_id', 'type', 'attribute', 'value', 'result', 'link_id'], 'required'],
            [['member_id', 'type', 'link_id'], 'integer'],
            [['value', 'result'], 'number'],
            [['attribute'], 'string', 'max' => 40],
            [['note'], 'string', 'max' => 255]
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
            'changeLog' => $this->getChangeLogBehaviorConfig($this->type),
        ];
    }

    public function getChangeLogBehaviorConfig($type)
    {
        $types = [
            static::TYPE_ACCOUNT_TO_PACKAGE => [
                'class' => Kiwi::getMemberStatisticClass(),
                'attribute' => $this->attribute,
                'condition' => ['member_id' => $this->member_id],
            ],
            static::TYPE_PACKAGE_TO_ACCOUNT => [
                'class' => Kiwi::getMemberStatisticClass(),
                'attribute' => $this->attribute,
                'condition' => ['member_id' => $this->member_id],
            ],
            static::TYPE_RECHARGE => [
                'class' => Kiwi::getMemberStatisticClass(),
                'attribute' => 'account_money',
                'condition' => ['member_id' => $this->member_id],
            ],
            static::TYPE_INVEST_EMPIRICAL => [
                'class' => Kiwi::getMemberStatisticClass(),
                'attribute' => 'empirical_value',
                'condition' => ['member_id' => $this->member_id],
            ]
        ];

        return isset($types[$type]) ? $types[$type] : [];
    }
}
