<?php

namespace p2p\activity\models;

use Yii;

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
            [['project_id', 'material', 'create_time'], 'required'],
            [['project_id', 'create_time', 'update_time', 'is_delete'], 'integer'],
            [['material'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_material' => Yii::t('p2p_activity', 'Project Material'),
            'project_id' => Yii::t('p2p_activity', 'Project ID'),
            'material' => Yii::t('p2p_activity', 'Material'),
            'create_time' => Yii::t('p2p_activity', 'Create Time'),
            'update_time' => Yii::t('p2p_activity', 'Update Time'),
            'is_delete' => Yii::t('p2p_activity', 'Is Delete'),
        ];
    }
}
