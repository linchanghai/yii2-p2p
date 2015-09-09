<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

namespace kiwi\searchers;

/**
 * Class NumberSearcher
 * @package kiwi\searchers
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class NumberSearcher  extends Searcher
{
    public $equal = true;

    /**
     * @inheritdoc
     */
    public function searchAttribute($object, $attribute)
    {
        $range = $object->getQueryParam($attribute);
        if ($this->equal) {
            if (isset($range['min'])) {
                $object->query->andFilterWhere(['>=', $this->getAttribute($object, $attribute), $range['min']]);
            }
            if (isset($range['max'])) {
                $object->query->andFilterWhere(['<=', $this->getAttribute($object, $attribute), $range['max']]);
            }
        } else {
            if (isset($range['min'])) {
                $object->query->andFilterWhere(['>', $this->getAttribute($object, $attribute), $range['min']]);
            }
            if (isset($range['max'])) {
                $object->query->andFilterWhere(['<', $this->getAttribute($object, $attribute), $range['max']]);
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function buildAttributeField($object, $attribute)
    {
        /** @var SearchField $searchField */
        $searchField = Yii::createObject(['class' => $this->searchFieldClass, 'model' => $object, 'attribute' => $attribute, 'labelOptions' => ['class' => 'control-label col-sm-1']]);
        $searchField->rangeInput(['class' => 'form-control col-sm-4', 'style' => 'width: 20%;']);
        return $searchField->render();
    }
}