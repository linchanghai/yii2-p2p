<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 5/28/2015
 * @Time 2:22 PM
 */

namespace kiwi\models\eav;


use kiwi\db\ActiveRecord;

/**
 * Class ValueModel
 *
 * @property EntityModel $entityModel
 * @property AttributeOptionModel $attributeOption
 *
 * @package kiwi\models\eav
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 */
class ValueModel extends ActiveRecord
{
    use EavTrait;

    public $valueAttribute = 'value';
}