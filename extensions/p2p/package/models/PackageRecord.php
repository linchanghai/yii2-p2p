<?php

namespace p2p\package\models;

use Yii;

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
 * @property Member $member
 */
class PackageRecord extends \kiwi\db\ActiveRecord
{
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
            [['member_id', 'exchange_cash', 'create_time'], 'required'],
            [['member_id', 'exchange_cash', 'type', 'create_time', 'is_delete'], 'integer']
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Member::className(), ['member_id' => 'member_id']);
    }
}
