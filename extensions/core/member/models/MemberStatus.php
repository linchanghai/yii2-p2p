<?php

namespace core\member\models;

use Yii;

/**
 * This is the model class for table "{{%member_status}}".
 *
 * @property integer $memeber_status_id
 * @property integer $member_id
 * @property integer $email_status
 * @property integer $mobile_status
 * @property integer $real_name_status
 * @property integer $id_cars_status
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $is_delete
 */
class MemberStatus extends \kiwi\db\ActiveRecord
{
    use MemberTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%member_status}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email_status', 'mobile_status', 'id_cars_status'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'memeber_status_id' => Yii::t('core_member', 'Memeber Status ID'),
            'member_id' => Yii::t('core_member', 'Member ID'),
            'email_status' => Yii::t('core_member', 'Email Status'),
            'mobile_status' => Yii::t('core_member', 'Mobile Status'),
            'real_name_status' => Yii::t('core_member', 'Real Name Status'),
            'id_cars_status' => Yii::t('core_member', 'Id Cars Status'),
            'create_time' => Yii::t('core_member', 'Create Time'),
            'update_time' => Yii::t('core_member', 'Update Time'),
            'is_delete' => Yii::t('core_member', 'Is Delete'),
        ];
    }
}
