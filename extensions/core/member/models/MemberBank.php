<?php

namespace core\member\models;

use Yii;

/**
 * This is the model class for table "{{%member_bank}}".
 *
 * @property integer $menber_bank_id
 * @property integer $member_id
 * @property string $bank_name
 * @property string $card_no
 * @property string $bank_user_name
 * @property string $province
 * @property string $city
 * @property string $branch_name
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $is_delete
 */
class MemberBank extends \kiwi\db\ActiveRecord
{
    use MemberTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%member_bank}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bank_name', 'card_no', 'bank_user_name', 'province', 'city', 'branch_name'], 'required'],
            [['bank_name'], 'string', 'max' => 30],
            [['card_no'], 'string', 'max' => 25],
            [['bank_user_name'], 'string', 'max' => 10],
            [['province', 'city'], 'string', 'max' => 20],
            [['branch_name'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'menber_bank_id' => Yii::t('core_member', 'Menber Bank ID'),
            'member_id' => Yii::t('core_member', 'Member ID'),
            'bank_name' => Yii::t('core_member', 'Bank Name'),
            'card_no' => Yii::t('core_member', 'Card No'),
            'bank_user_name' => Yii::t('core_member', 'Bank User Name'),
            'province' => Yii::t('core_member', 'Province'),
            'city' => Yii::t('core_member', 'City'),
            'branch_name' => Yii::t('core_member', 'Branch Name'),
            'create_time' => Yii::t('core_member', 'Create Time'),
            'update_time' => Yii::t('core_member', 'Update Time'),
            'is_delete' => Yii::t('core_member', 'Is Delete'),
        ];
    }
}
