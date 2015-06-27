<?php

namespace p2p\package\models;

use kiwi\Kiwi;
use kiwi\behaviors\RecordBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%package_record}}".
 *
 * @property integer $package_record_id
 * @property integer $member_id
 * @property integer $exchange_cash
 * @property integer $type
 * @property integer $create_time
 * @property integer $is_delete
 *
 * @property \core\member\models\Member $member
 */
class PackageRecord extends \kiwi\db\ActiveRecord
{
    const TYPE_INTO = 1;
    const TYPE_OUT = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%package_record}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'exchange_cash'], 'required'],
            [['member_id', 'exchange_cash', 'type'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'package_record_id' => Yii::t('p2p_package', 'Package Record ID'),
            'member_id' => Yii::t('p2p_package', 'Member ID'),
            'exchange_cash' => Yii::t('p2p_package', 'Exchange Cash'),
            'type' => Yii::t('p2p_package', 'Type'),
            'create_time' => Yii::t('p2p_package', 'Create Time'),
            'is_delete' => Yii::t('p2p_package', 'Is Delete'),
        ];
    }

    public function behaviors()
    {
        $recordClass = Kiwi::getStatisticChangeRecordClass();
        return [
            'time' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => false
            ],
            'changeAccount' => [
                'class' => RecordBehavior::className(),
                'targetClass' => $recordClass,
                'attributes' => [
                    'type' => $this->type == $this::TYPE_INTO
                        ? $recordClass::TYPE_ACCOUNT_TO_PACKAGE
                        : $recordClass::TYPE_PACKAGE_TO_ACCOUNT,
                    'attribute' => $recordClass::tableName() . '.' . 'account_money',
                    'value' => function() {
                        return $this->type == $this::TYPE_INTO ? -$this->exchange_cash : $this->exchange_cash;
                    },
                    'member_id' => 'member_id',
                    'link_id' => 'primaryKey',
                ]
            ],
            'changePackage' => [
                'class' => RecordBehavior::className(),
                'targetClass' => $recordClass,
                'attributes' => [
                    'type' => $this->type == $this::TYPE_INTO
                        ? $recordClass::TYPE_ACCOUNT_TO_PACKAGE
                        : $recordClass::TYPE_PACKAGE_TO_ACCOUNT,
                    'attribute' => $recordClass::tableName() . '.' . 'package_money',
                    'value' => function() {
                        return $this->type == $this::TYPE_INTO ? $this->exchange_cash : -$this->exchange_cash;
                    },
                    'member_id' => 'member_id',
                    'link_id' => 'primaryKey',
                ]
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Kiwi::getMemberClass(), ['member_id' => 'member_id']);
    }
}
