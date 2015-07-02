<?php

namespace core\member\models;

use kiwi\Kiwi;
use p2p\activity\models\ProductMap;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%member_coupon}}".
 *
 * @property integer $member_coupon_id
 * @property integer $member_id
 * @property integer $type
 * @property string $value
 * @property integer $used_time
 * @property integer $expire_date
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $is_delete
 *
 * @property Member $member
 */
class MemberCoupon extends \kiwi\db\ActiveRecord
{

    const STATUS_USED = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%member_coupon}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'type', 'value','expire_date'], 'required'],
            [['member_id', 'type', 'used_time', 'status', 'create_time', 'update_time', 'is_delete','expire_date'], 'integer'],
            [['expire_date'], 'safe'],
            [['value'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'member_coupon_id' => Yii::t('core_member', 'Member Coupon ID'),
            'member_id' => Yii::t('core_member', 'Member ID'),
            'type' => Yii::t('core_member', 'Type'),
            'value' => Yii::t('core_member', 'Value'),
            'used_time' => Yii::t('core_member', 'Used Time'),
            'expire_date' => Yii::t('core_member', 'Expire Date'),
            'status' => Yii::t('core_member', 'Status'),
            'create_time' => Yii::t('core_member', 'Create Time'),
            'update_time' => Yii::t('core_member', 'Update Time'),
            'is_delete' => Yii::t('core_member', 'Is Delete'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Member::className(), ['member_id' => 'member_id']);
    }

    public function exchangeCoupon(ProductMap $productMap){
        /**@var $memberStatisticModel MemberStatistic **/
        $memberStatisticModel = Kiwi::getMemberCoupon()->findOne(Yii::$app->user->id);
        if($productMap->exchange_points <= $memberStatisticModel->points){
            $this->member_id = Yii::$app->user->id;
            $this->type = $productMap->type;
            $this->value = $productMap->exchange_value;
            $this->expire_date = $productMap->duration;
            $this->value = $productMap->exchange_value;
            if($this->save()){
                return true;
            }
        }
        return false;
    }

    public function behaviors()
    {
        return [
            'time' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => 'update_time',
            ],
        ];
    }
}
