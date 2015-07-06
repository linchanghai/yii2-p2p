<?php

namespace p2p\activity\models;

use kiwi\behaviors\ChangeLogBehavior;
use kiwi\behaviors\RecordBehavior;
use kiwi\Kiwi;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "exchange_record".
 *
 * @property integer $exchange_records_id
 * @property integer $member_id
 * @property integer $product_map_id
 * @property string $note
 * @property integer $quantity
 * @property integer $create_time
 * @property integer $is_delete
 *
 * @property Member $member
 * @property ProductMap $productMap
 */
class ExchangeRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exchange_record';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['note', 'default', 'value' => 'xxx'],
            [['member_id', 'product_map_id','quantity'], 'required'],
            [['member_id', 'product_map_id', 'create_time', 'is_delete','quantity'], 'integer'],
            [['note'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'exchange_records_id' => Yii::t('p2p_activity', 'Exchange Records ID'),
            'member_id' => Yii::t('p2p_activity', 'Member ID'),
            'product_map_id' => Yii::t('p2p_activity', 'Product Map ID'),
            'note' => Yii::t('p2p_activity', 'Note'),
            'quantity' => Yii::t('p2p_activity', 'Quantity'),
            'create_time' => Yii::t('p2p_activity', 'Create Time'),
            'is_delete' => Yii::t('p2p_activity', 'Is Delete'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Member::className(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductMap()
    {
        return $this->hasOne(ProductMap::className(), ['product_map_id' => 'product_map_id']);
    }

    public function behaviors()
    {
        $changeRecordClass = Kiwi::getStatisticChangeRecordClass();
        return [
            'coupon' => [
                'class' => RecordBehavior::className(),
                'targetClass' => 'core\member\models\MemberCoupon',
                'attributes' => [
                    'member_id'=> 'member_id',
                    'type' => 'productMap.type',
                    'value' => 'productMap.exchange_value',
                    'expire_date' => 'expireDate',
                ],
                'saveTime'=>'quantity',
            ],
            'updatePoint' => [
                'class' => RecordBehavior::className(),
                'targetClass' => 'core\member\models\StatisticChangeRecord',
                'attributes' => [
                    'member_id'=> 'member_id',
                    'type' => $changeRecordClass::TYPE_EXCHANGE_POINT,
                    'value' => function($record) { return -$record->productMap->exchange_points; },
                    'link_id' => 'exchange_records_id'
                ],
            ],
            'time' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_time',
                 'updatedAtAttribute' => false,
            ],
        ];
    }

    public function getExpireDate(){
        return $this->productMap->duration + time();
    }

    public function transactions(){
        return [
            static::SCENARIO_DEFAULT => static::OP_ALL
        ];
    }
}
