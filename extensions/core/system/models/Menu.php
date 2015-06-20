<?php

namespace core\system\models;

use core\tree\models\Tree;
use kiwi\Kiwi;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property string $url
 * @property integer $status
 */
class Menu extends Tree
{
    const TYPE_DEFAULT = 'menu';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'url' => Yii::t('core_system', 'Url'),
            'status' => Yii::t('core_system', 'Is Active'),
        ]);
    }
}
