<?php

namespace p2p\activity\models;

use kiwi\Kiwi;
use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "product_map".
 *
 * @property integer $product_map_id
 * @property integer $type
 * @property string $exchange_value
 * @property integer $exchange_points
 * @property integer $duration
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $is_delete
 *
 * @property ExchangeRecord[] $exchangeRecords
 */
class ProductMap extends \kiwi\db\ActiveRecord
{
    const CouponBonus = 1;
    const CouponCash = 2;
    const CouponAnnual = 3;

    public function getTypeArray(){
        return [
            self::CouponBonus => Yii::t('p2p_activity', 'Coupon Bonus'),
            self::CouponCash => Yii::t('p2p_activity', 'Coupon Cash'),
            self::CouponAnnual => Yii::t('p2p_activity', 'Coupon Annual'),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_map';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'type', 'exchange_value', 'exchange_points'], 'required'],
            [[ 'type', 'exchange_points', 'duration', 'create_time', 'update_time', 'is_delete'], 'integer'],
            [['exchange_value'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_map_id' => Yii::t('p2p_activity', 'Product Map ID'),
            'type' => Yii::t('p2p_activity', 'Type'),
            'exchange_value' => Yii::t('p2p_activity', 'Exchange Value'),
            'exchange_points' => Yii::t('p2p_activity', 'Exchange Points'),
            'duration' => Yii::t('p2p_activity', 'Duration'),
            'create_time' => Yii::t('p2p_activity', 'Create Time'),
            'update_time' => Yii::t('p2p_activity', 'Update Time'),
            'is_delete' => Yii::t('p2p_activity', 'Is Delete'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExchangeRecords()
    {
        return $this->hasMany(ExchangeRecord::className(), ['product_map_id' => 'product_map_id']);
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
