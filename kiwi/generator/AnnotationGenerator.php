<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

namespace kiwi\generator;

use kiwi\Kiwi;
use Yii;
use yii\base\Object;
use yii\helpers\FileHelper;

/**
 * Class AnnotationGenerator
 *
 * just for code intelligent
 *
 * @package kiwi
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class AnnotationGenerator extends Object
{
    public $annotationDir = '@runtime/annotation';

    public function init()
    {
        $this->annotationDir = Yii::getAlias($this->annotationDir);
        FileHelper::createDirectory(Yii::getAlias($this->annotationDir));
    }

    public function generate()
    {
        $classes = ['Application', 'Kiwi', 'Configuration', 'DataListModel', 'SettingModel'];
        foreach ($classes as $class) {
            $generateFunc = 'generate' . ucfirst($class);
            $this->$generateFunc();
        }
    }

    public function generateApplication()
    {
        $annotations = [];
        $components = Yii::$app->getComponents();
        foreach ($components as $name => $definition) {
            $class = is_array($definition) ? $definition['class'] : $definition;
            $class = '\\' . trim($class, '\\');
            $annotations[] = " * @property {$class} {$name}";
        }


        $annotations = implode("\n", $annotations);

        $content = <<<EOF
<?php

namespace yii\web;

exit("This file should not be included, only analyzed by your IDE");

/**
{$annotations}
 */
class Application extends \yii\base\Application
{
}
EOF;
        $classFile = $this->annotationDir . '/_Application.php';
        file_put_contents($classFile, $content);
    }

    public function generateKiwi()
    {
        if ($classes = Kiwi::$classMap) {
            $annotations = [];
            foreach (['singleton', 'class'] as $key) {
                if (isset($classes[$key])) {
                    foreach ($classes[$key] as $name => $class) {
                        if (strpos($name, '\\') !== false) {
                            continue;
                        }
                        $name = ucfirst($name);
                        $annotations[] = " * @method static \\{$class} get{$name}(\$config = [], \$params = [])";
                    }
                }
            }

            foreach (['singleton', 'class'] as $key) {
                if (isset($classes[$key])) {
                    foreach ($classes[$key] as $name => $class) {
                        if (strpos($name, '\\') !== false) {
                            continue;
                        }
                        $name = ucfirst($name);
                        $annotations[] = " * @method static string|\\{$class} get{$name}Class()";
                    }
                }
            }

            $annotations = implode("\n", $annotations);

            $content = <<<EOF
<?php

namespace kiwi;

exit("This file should not be included, only analyzed by your IDE");

/**
{$annotations}
 */
class Kiwi
{
}
EOF;
            $classFile = $this->annotationDir . '/_Kiwi.php';
            file_put_contents($classFile, $content);
        }
    }

    public function generateConfiguration()
    {
        if ($configuration = Kiwi::getConfiguration()) {
            $annotations = [];
            foreach ($configuration->configValues as $key => $value) {
                $annotations[] = " * @property array {$key}";
            }
            foreach ($configuration->configValues as $key => $value) {
                $key = ucfirst($key);
                $annotations[] = " * @method array get{$key}()";
            }
            $annotations = implode("\n", $annotations);

            $content = <<<EOF
<?php

namespace kiwi;

exit("This file should not be included, only analyzed by your IDE");

/**
{$annotations}
 */
class Configuration
{
}
EOF;
            $classFile = $this->annotationDir . '/_Configuration.php';
            file_put_contents($classFile, $content);
        }

    }

    public function generateDataListModel()
    {
        if ($dataList = Kiwi::getConfiguration()->dataLists) {
            $dataListKeys = array_keys($dataList);
            $annotations = array_map(function ($key) {
                $key = lcfirst($key);
                return " * @property array {$key}";
            }, $dataListKeys);

            $annotations = implode("\n", $annotations);

            $content = <<<EOF
<?php

namespace core\system\models;

exit("This file should not be included, only analyzed by your IDE");

/**
{$annotations}
 */
class DataListModel
{
}
EOF;
            $classFile = $this->annotationDir . '/_DataList.php';
            file_put_contents($classFile, $content);
        }
    }

    public function generateSettingModel()
    {
        if ($setting = Kiwi::getConfiguration()->settings) {
            foreach ($setting as $tabKey => $tabConfig) {
                foreach ($tabConfig['groups'] as $groupKey => $groupConfig) {
                    foreach ($groupConfig['fields'] as $fieldKey => $fieldConfig) {
                        $annotations[] = " * @property string {$tabKey}_{$groupKey}_{$fieldKey}";
                    }
                }
            }

            $annotations = implode("\n", $annotations);

            $content = <<<EOF
<?php

namespace core\system\models;

exit("This file should not be included, only analyzed by your IDE");

/**
{$annotations}
 */
class SettingModel
{
}
EOF;
            $classFile = $this->annotationDir . '/_Setting.php';
            file_put_contents($classFile, $content);
        }
    }
}