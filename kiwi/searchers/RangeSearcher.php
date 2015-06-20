<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

namespace kiwi\searchers;

/**
 * Class RangeSearcher
 * @package kiwi\searchers
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class RangeSearcher  extends Searcher
{
    /**
     * @var array list of valid values that the attribute value should be among
     */
    public $range;

    public $multi = false;

    /**
     * @inheritdoc
     */
    public function searchAttribute($object, $attribute)
    {
        if ($this->multi) {
            $object->query->andFilterWhere(['in', $this->getAttribute($object, $attribute), $object->getQueryParam($attribute)]);
        } else {
            $object->query->andFilterWhere([$this->getAttribute($object, $attribute) => $object->getQueryParam($attribute)]);
        }
    }

    /**
     * @inheritdoc
     */
    public function buildAttributeField($object, $attribute)
    {
        /** @var SearchField $searchField */
        $searchField = Yii::createObject(['class' => $this->searchFieldClass, 'model' => $object, 'attribute' => $attribute, 'labelOptions' => ['class' => 'control-label col-sm-1']]);
        if ($this->multi) {
            $inputHtml = '';
            foreach ($this->range as $value => $label) {
                $inputHtml .= '<label><input type="checkbox" name="' . $object->formName() . '[' . $attribute . '][' . $value . ']" value="' . $value . '"' . (is_array($object->$attribute) && in_array($value, $object->$attribute) ? 'checked="checked"' : '') . '>' . $label . '</label>';
            }
            $searchField->parts['{input}'] = $inputHtml;
        } else {
            $searchField->dropDownList($this->range, ['class' => 'col-sm-4']);
        }
        return $searchField->render();
    }
}