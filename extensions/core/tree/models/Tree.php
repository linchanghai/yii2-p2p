<?php

namespace core\tree\models;

use gilek\gtreetable\models\TreeModel;
use Yii;

/**
 * This is the model class for table "{{%tree}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $root
 * @property integer $lft
 * @property integer $rgt
 * @property integer $level
 * @property string $type
 */
class Tree extends TreeModel
{
    public function findNestedSet() {
        return parent::findNestedSet()->where(['type' => static::TYPE_DEFAULT]);
    }

    /**
     * @inheritdoc
     */
    public static function find()
    {
        return parent::find()->where(['type' => static::TYPE_DEFAULT]);
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert) {
        parent::beforeSave($insert);

        if ($this->isNewRecord) {
            $this->{$this->typeAttribute} = static::TYPE_DEFAULT;
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tree}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('core_tree', 'ID'),
            'name' => Yii::t('core_tree', 'Name'),
            'root' => Yii::t('core_tree', 'Root'),
            'lft' => Yii::t('core_tree', 'Lft'),
            'rgt' => Yii::t('core_tree', 'Rgt'),
            'level' => Yii::t('core_tree', 'Level'),
            'type' => Yii::t('core_tree', 'Type'),
        ];
    }

    public static function getTreeItems($glue = ' » ')
    {
        /** @var Tree[] $treeNodes */
        $treeNodes = static::find()->addOrderBy(['root' => SORT_ASC, 'lft' => SORT_ASC])->indexBy('id')->all();
        $treeNodes = array_map(function ($treeNode) use ($glue) {
            $level = $treeNode->level;
            $name = $treeNode->name;
            while (--$level) {
                $name = $glue . $name;
            }
            return $name;
        }, $treeNodes);
        return $treeNodes;
    }
}
