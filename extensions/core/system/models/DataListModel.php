<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 6/6/2015
 * @Time 5:41 PM
 */

namespace core\system\models;


use kiwi\Kiwi;
use Yii;
use yii\bootstrap\Tabs;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;

class DataListModel extends \kiwi\models\DataListModel
{
    /** @var \yii\db\ActiveRecord */
    public $modelClass = 'core\system\models\DataList';

    public function getDataLists($onlyDB = true)
    {
        $dataLists = Kiwi::getConfiguration()->dataLists;
        return $onlyDB ? array_filter($dataLists, function($dataList) { return isset($dataList[$this->isDBKey]); }) : $dataLists;
    }

    public function renderIndex($activeType = '')
    {
        $tabItems = [];
        $dataLists = $this->getDataLists();
        $model = $this->modelClass;

        foreach ($dataLists as $type => $dataList) {
            if (empty($dataList[$this->isDBKey])) {
                continue;
            }

            $dataProvider = new ActiveDataProvider([
                'query' => $model::find()->andwhere([$this->typeAttribute => $type, $this->isRemovedAttribute => 0])
            ]);

            $tabContent = '<br />' . Html::tag('p', Html::a(Yii::t('core_system', 'Add {type} Value', ['type' => $dataList[$this->labelKey]]), ['create', 'type' => $type], ['class' => 'btn btn-success']));
            $tabContent .= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    $this->keyAttribute,
                    $this->valueAttribute,
                    ['class' => 'yii\grid\ActionColumn', 'template' => '{update}{delete}'],
                ],
            ]);

            if ($activeType == $type) {
                $tabItems[] = [
                    'label' => $dataList[$this->labelKey],
                    'content' => $tabContent,
                    'active' => true,
                ];
            } else {
                $tabItems[] = [
                    'label' => $dataList[$this->labelKey],
                    'content' => $tabContent,
                ];
            }
        }
        return Tabs::widget(['items' => $tabItems]);
    }
}