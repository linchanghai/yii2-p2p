<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

namespace kiwi\searchers;

/**
 * Class DataSearcher
 * @package kiwi\searchers
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class DataSearcher extends Searcher
{
    /**
     * @inheritdoc
     */
    public function searchAttribute($object, $attribute)
    {
        $range = $object->getQueryParam($attribute);
        if (isset($range['min']) && $startTime = strtotime($range['min'])) {
            $object->query->andFilterWhere(['>=', $this->getAttribute($object, $attribute), $startTime]);
        }
        if (isset($range['max']) && $endTime = strtotime($range['max'])) {
            $object->query->andFilterWhere(['<=', $this->getAttribute($object, $attribute), $endTime]);
        }
    }

    /**
     * @inheritdoc
     */
    public function buildAttributeField($object, $attribute)
    {
        /** @var SearchField $searchField */
        $searchField = Yii::createObject(['class' => $this->searchFieldClass, 'model' => $object, 'attribute' => $attribute, 'labelOptions' => ['class' => 'control-label col-sm-1']]);
        $searchField->dateRangeInput();
        return $searchField->render();
    }
} 