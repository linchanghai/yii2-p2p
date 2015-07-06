<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 5/28/2015
 * @Time 2:21 PM
 */

namespace kiwi\models\eav;


use kiwi\db\ActiveRecord;
use Yii;

/**
 * Class AttributeModel
 *
 * @property AttributeSetModel $attributeSetModel
 * @property AttributeOptionModel[] $attributeOptionModels
 *
 * @package kiwi\models\eav
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 */
class AttributeModel extends ActiveRecord
{
    use EavTrait;

//    public $keyAttribute = 'key';

    public $labelAttribute = 'label';

    public $defaultValueAttribute = 'default_value';

    public $isRequiredAttribute = 'is_required';

    public $dataListAttribute = 'data_list';

    public $dataSourceAttribute = 'data_source';

    public $inputTypeAttribute = 'input_type';

    public $dataTypeAttribute = 'data_type';
}