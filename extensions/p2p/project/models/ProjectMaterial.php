<?php

namespace p2p\project\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "project_material".
 *
 * @property integer $project_material
 * @property integer $project_id
 * @property string $material
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $is_delete
 */
class ProjectMaterial extends \kiwi\db\ActiveRecord
{
    public static $enableLogicDelete = true;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_material';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['material'], 'required'],
            [['material'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_material' => Yii::t('p2p_project', 'Project Material'),
            'project_id' => Yii::t('p2p_project', 'Project ID'),
            'material' => Yii::t('p2p_project', 'Material'),
            'create_time' => Yii::t('p2p_project', 'Create Time'),
            'update_time' => Yii::t('p2p_project', 'Update Time'),
            'is_delete' => Yii::t('p2p_project', 'Is Delete'),
        ];
    }

    public function behaviors()
    {
        return [
            'time' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => 'update_time',
            ]
        ];
    }
}
