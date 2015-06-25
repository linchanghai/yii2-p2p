<?php

namespace core\member\models;

use kiwi\behaviors\ChangeLogBehavior;
use Yii;

/**
 * This is the model class for table "{{%statistic_change_record}}".
 *
 * @property integer $statistic_change_record_id
 * @property integer $member_id
 * @property integer $type
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
            [['member_id', 'type', 'value', 'result', 'link_id', 'note', 'create_time'], 'required'],
            [['member_id', 'type', 'link_id', 'create_time', 'is_delete'], 'integer'],
            [['value', 'result'], 'number'],
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
            'changeLog' => [
                'class' => ChangeLogBehavior::className(),
                'types' => [
                    static::TYPE_RECHARGE => [
                        'class' => 'core\member\models\MemberStatistic',
                        'attribute' => 'account_money',
                        'condition' => ['member_id' => $this->member_id],
                    ]
                ],
            ],
        ];
    }
}
