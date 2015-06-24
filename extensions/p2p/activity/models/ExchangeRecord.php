<?php

namespace p2p\activity\models;

use p2p\activity\behaviors\RecordBehavior;
use Yii;

/**
 * This is the model class for table "exchange_record".
 *
 * @property integer $exchange_records_id
 * @property integer $member_id
 * @property integer $product_map_id
 * @property string $note
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
            [['member_id', 'product_map_id', 'create_time'], 'required'],
            [['member_id', 'product_map_id', 'create_time', 'is_delete'], 'integer'],
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
        return [
            'coupon' => RecordBehavior::className(),
        ];
    }
}