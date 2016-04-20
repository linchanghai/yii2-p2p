<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 5/28/2015
 * @Time 4:27 PM
 */

namespace kiwi\models\eav;

use Yii;

/**
 * Class EavTrait
 * @package kiwi\models\eav
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 */
Trait EavTrait
{
    /** @var AttributeSetModel */
    public $attributeSetClass;

    public $attributeSetIdAttribute;

    /** @var AttributeModel */
    public $attributeClass;

    public $attributeIdAttribute;

    /** @var AttributeOptionModel */
    public $attributeOptionClass;

    public $attributeOptionIdAttribute;

    /** @var EntityModel */
    public $entityClass;

    public $entityIdAttribute;

    /** @var ValueModel */
    public $valueClass;

    public $valueIdAttribute;


    public function getAttributeSetModel()
    {
        return $this->hasOne($this->attributeSetClass, [$this->attributeSetIdAttribute, $this->attributeSetIdAttribute]);
    }

    public function getAttributeModels()
    {
        return $this->hasMany($this->attributeClass, [$this->attributeSetIdAttribute, $this->attributeSetIdAttribute]);
    }

    public function getEntityModels()
    {
        return $this->hasMany($this->entityClass, [$this->attributeSetIdAttribute, $this->attributeSetIdAttribute]);
    }


    public function getAttributeModel()
    {
        return $this->hasOne($this->attributeClass, [$this->attributeIdAttribute, $this->attributeIdAttribute]);
    }

    public function getAttributeOptionModels()
    {
        return $this->hasMany($this->attributeOptionClass, [$this->attributeIdAttribute, $this->attributeIdAttribute]);
    }


    public function getEntityModel()
    {
        return $this->hasOne($this->attributeOptionClass, [$this->entityIdAttribute, $this->entityIdAttribute]);
    }

    public function getValueModels()
    {
        return $this->hasMany($this->valueClass, [$this->entityIdAttribute, $this->entityIdAttribute]);
    }


    public function getAttributeOptionModel()
    {
        return $this->hasOne($this->attributeOptionClass, [$this->attributeOptionIdAttribute, $this->attributeOptionIdAttribute]);
    }
}