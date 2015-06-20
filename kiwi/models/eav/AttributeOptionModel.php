<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 5/28/2015
 * @Time 3:05 PM
 */

namespace kiwi\models\eav;


use kiwi\db\ActiveRecord;

/**
 * Class AttributeOptionModel
 *
 * @property AttributeModel $attributeModel
 * @property ValueModel[] $valueModels
 *
 * @package kiwi\models\eav
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 */
class AttributeOptionModel extends ActiveRecord
{
    use EavTrait;

    public function getValueModels()
    {
        return $this->hasMany($this->valueClass, [$this->attributeOptionIdAttribute, $this->attributeOptionIdAttribute]);
    }
}