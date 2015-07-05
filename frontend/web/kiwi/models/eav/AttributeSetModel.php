<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 5/28/2015
 * @Time 2:26 PM
 */

namespace kiwi\models\eav;


use kiwi\db\ActiveRecord;
use Yii;

/**
 * Class AttributeSetModel
 *
 * @property AttributeModel[] $attributeModels
 * @property EntityModel[] $entityModels
 *
 * @package kiwi\models\eav
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 */
class AttributeSetModel extends ActiveRecord
{
    use EavTrait;
}