<?php

namespace core\cms\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "cms_contact".
 *
 * @property integer $cms_contact_id
 * @property string $address
 * @property string $phone
 * @property string $qq
 * @property string $weibo
 * @property string $weixin
 * @property integer $create_time
 * @property integer $update_time
 * @property string $create_by
 * @property string $update_by
 * @property integer $is_delete
 */
class CmsContact extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address', 'phone', 'qq', 'weibo', 'weixin', 'create_time', 'create_by'], 'required'],
            [['create_time', 'update_time', 'is_delete'], 'integer'],
            [['address', 'weibo'], 'string', 'max' => 200],
            [['phone', 'weixin'], 'string', 'max' => 100],
            [['qq', 'create_by', 'update_by'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cms_contact_id' => Yii::t('core_cms', 'Cms Contact ID'),
            'address' => Yii::t('core_cms', 'Address'),
            'phone' => Yii::t('core_cms', 'Phone'),
            'qq' => Yii::t('core_cms', 'Qq'),
            'weibo' => Yii::t('core_cms', 'Weibo'),
            'weixin' => Yii::t('core_cms', 'Weixin'),
            'create_time' => Yii::t('core_cms', 'Create Time'),
            'update_time' => Yii::t('core_cms', 'Update Time'),
            'create_by' => Yii::t('core_cms', 'Create By'),
            'update_by' => Yii::t('core_cms', 'Update By'),
            'is_delete' => Yii::t('core_cms', 'Is Delete'),
        ];
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
