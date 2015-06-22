<?php

namespace p2p\package\models;

use Yii;

/**
 * This is the model class for table "{{%package_interest_record}}".
 *
 * @property integer $package_interest_record_id
 * @property integer $member_id
 * @property string $daily_interest
 * @property string $target_date
 * @property integer $create_time
 * @property integer $is_delete
 *
 * @property PackageInterestRecord $member
 * @property PackageInterestRecord[] $packageInterestRecords
 */
class PackageInterestRecord extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%package_interest_record}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'daily_interest', 'target_date', 'create_time'], 'required'],
            [['member_id', 'create_time', 'is_delete'], 'integer'],
            [['daily_interest'], 'number'],
            [['target_date'], 'string', 'max' => 8]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'package_interest_record_id' => Yii::t('p2p_package', 'Package Interest Record ID'),
            'member_id' => Yii::t('p2p_package', 'Member ID'),
            'daily_interest' => Yii::t('p2p_package', 'Daily Interest'),
            'target_date' => Yii::t('p2p_package', 'Target Date'),
            'create_time' => Yii::t('p2p_package', 'Create Time'),
            'is_delete' => Yii::t('p2p_package', 'Is Delete'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(PackageInterestRecord::className(), ['package_interest_record_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPackageInterestRecords()
    {
        return $this->hasMany(PackageInterestRecord::className(), ['member_id' => 'package_interest_record_id']);
    }
}
