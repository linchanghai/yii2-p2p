<?php

namespace p2p\activity\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "project_legal_opinion".
 *
 * @property integer $project_legal_opinion_id
 * @property integer $project_id
 * @property string $legal_info
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $is_delete
 */
class ProjectLegalOpinion extends \kiwi\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_legal_opinion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['legal_info'], 'required'],
            [['legal_info'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_legal_opinion_id' => Yii::t('p2p_activity', 'Project Legal Opinion ID'),
            'project_id' => Yii::t('p2p_activity', 'Project ID'),
            'legal_info' => Yii::t('p2p_activity', 'Legal Info'),
            'create_time' => Yii::t('p2p_activity', 'Create Time'),
            'update_time' => Yii::t('p2p_activity', 'Update Time'),
            'is_delete' => Yii::t('p2p_activity', 'Is Delete'),
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
