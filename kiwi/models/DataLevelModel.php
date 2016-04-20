<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 * @Date 5/29/2015
 * @Time 7:01 PM
 */

namespace kiwi\models;


use kiwi\helpers\CheckHelper;
use yii\base\Object;

/**
 * Class DataLevelModel
 *
 * 'dataLevel' => [
 *      'vip' => [
 *          'label' => Yii::t('app', 'VIP'),
 *          'levels' => [
 *              'vip1' => [
 *                  'label' => Yii::t('app', 'VIP1'),
 *                  'from' => 0
 *                  'to' => 100
 *              ],
 *              'vip2' => [
 *                  'label' => Yii::t('app', 'VIP1'),
 *                  'from' => 101
 *                  'to' => 1000
 *              ]
 *          ],
 *          'isDB' => false
 *      ]
 * ]
 *
 * @package kiwi\models
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 */
abstract class DataLevelModel extends Object
{
    /** @var \yii\db\ActiveRecord */
    public $modelClass;

    public $typeAttribute = 'type';

    public $keyAttribute = 'key';

    public $labelAttribute = 'label';

    public $fromAttribute = 'from';

    public $toAttribute = 'to';

    public $isRemovedAttribute = 'is_removed';

    public $labelKey = 'label';

    public $levelsKey = 'levels';

    public $levelSourceKey = 'levelSource';

    public $fromKey = 'from';

    public $toKey = 'to';

    public $isDBKey = 'isDB';

    abstract public function getDefinition($type);

    public function getLevels($type)
    {
        $dataLevels = $this->getDefinition($type);
        if (!$dataLevels) {
            return [];
        }

        $levels = isset($dataLevels[$this->levelsKey]) ? $dataLevels[$this->levelsKey] : [];
        $levels = isset($dataLevels[$this->levelSourceKey]) && CheckHelper::isCallable($dataLevels[$this->levelSourceKey])
            ? call_user_func($dataLevels[$this->levelSourceKey]) : $levels;

        if (isset($dataLevels[$this->isDBKey]) && $dataLevels[$this->isDBKey]) {
            $model = $this->modelClass;
            $models = $model::find()->andWhere([$this->typeAttribute => $type])->all();
            foreach ($models as $m) {
                if ($m->hasAttribute($this->isRemovedAttribute) && $m->{$this->isRemovedAttribute}) {
                    if (isset($levels[$m->{$this->keyAttribute}])) {
                        unset($levels[$m->{$this->keyAttribute}]);
                    }
                } else {
                    $levels[$m->{$this->keyAttribute}] = [
                        $this->labelKey => $m->{$this->labelAttribute},
                        $this->fromKey => $m->{$this->fromAttribute},
                        $this->toKey => $m->{$this->toAttribute},
                    ];
                }
            }
        }
        return $levels;
    }

    public function getCurrentLevel($value, $type)
    {
        $levels = $this->getLevels($type);
        foreach ($levels as $key => $level) {
            if ($value >= $level[$this->fromKey] && $value <= $level[$this->toKey]) {
                return $key;
            }
        }
        return null;
    }
}