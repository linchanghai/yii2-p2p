<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

namespace kiwi\searchers;

/**
 * Class StringSearcher
 * @package kiwi\searchers
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class StringSearcher extends Searcher
{
    public $like = true;

    /**
     * @inheritdoc
     */
    public function searchAttribute($object, $attribute)
    {
        if ($this->like) {
            $object->query->andFilterWhere(['like', $this->getAttribute($object, $attribute), $object->getQueryParam($attribute)]);
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
        $searchField->textInput(['value' => $object->getQueryParam($attribute), 'class' => 'form-control col-md-9', 'style' => 'width: 300px']);
        return $searchField->render();
    }
}