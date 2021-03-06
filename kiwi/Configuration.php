<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 * @Date 6/2/2015
 * @Time 4:44 PM
 */

namespace kiwi;


use kiwi\base\AspectTrait;
use kiwi\helpers\DirHelper;
use Yii;
use yii\base\Object;
use yii\helpers\ArrayHelper;

/**
 * Class Configuration
 *
 * @property array $namespaces
 * @property array $modules
 * @property array $configFiles;
 * @property array $configValues;
 * @property array $classes
 * @property array $controllers
 * @property array $views
 * @property array $config
 * @property array $defaultConfig
 * @property array $aspect
 *
 * @package kiwi
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 */
class Configuration extends Object
{
    use AspectTrait;

    public $codePools = ['@extensions'];

    public $defaultConfigFiles = ['controllers', 'views', 'config', 'aspect'];

    public $messagePath = '@common/messages';

    /**
     * @inheritdoc
     */
    public function _get($name)
    {
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            return $this->$getter();
        } else {
            $config = $this->configValues;
            return isset($config[$name]) ? $config[$name] : [];
        }
    }

    /**
     * @inheritdoc
     */
    public function __call($name, $params)
    {
        if (strlen($name) > 3 && substr($name, 0, 3) === 'get') {
            $key = lcfirst(substr($name, 3));
            $config = $this->configValues;
            return isset($config[$key]) ? $config[$key] : [];
        }
        return parent::__call($name, $params);
    }

    /**
     * get module namespaces
     * @return array
     */
    public function getNamespaces()
    {
        $namespaces = [];
        foreach ($this->codePools as $codePoolDir) {
            $codePoolDir = Yii::getAlias($codePoolDir);
            $namespaceDirs = DirHelper::findDirs($codePoolDir);
            foreach ($namespaceDirs as $namespaceDir) {
                $dirNames = explode(DIRECTORY_SEPARATOR, $namespaceDir);
                $namespace = end($dirNames);
                $namespaces[$namespace] = $namespaceDir;
            }
        }
        return $namespaces;
    }

    /**
     * get module definitions
     * @return array
     */
    public function getModules()
    {
        $modules = [];
        foreach ($this->namespaces as $namespace => $namespaceDir) {
            $moduleDirs = DirHelper::findDirs($namespaceDir);
            foreach ($moduleDirs as $moduleDir) {
                $dirNames = explode(DIRECTORY_SEPARATOR, $moduleDir);
                $module = end($dirNames);

                /** @var \kiwi\base\Module $moduleClass */
                $moduleClass = $namespace . '\\' . $module . '\\Module';

                if (class_exists($moduleClass) && $moduleClass::$active) {
                    if ((empty($moduleClass::$only) || in_array(Yii::$app->id, $moduleClass::$only))
                        && (empty($moduleClass::$except) || !in_array(Yii::$app->id, $moduleClass::$except))
                    ) {
                        $moduleName = $namespace . '_' . $module;
                        $modules[$moduleName] = $moduleClass;
                    }
                }
            }
        }
        return $this->sortModules($modules);
    }

    /**
     * get all config files, include module defined
     * @return array
     */
    public function getConfigFiles()
    {
        $configFiles = $this->defaultConfigFiles;
        foreach ($this->modules as $moduleName => $moduleClass) {
            $configFiles = ArrayHelper::merge($configFiles, $moduleClass::$config);
        }
        $configFiles = array_unique($configFiles);
        return $configFiles;
    }

    /**
     * get all config value, merge all config files
     * @param array $configFiles
     * @return array
     */
    public function getConfigValues($configFiles = [])
    {
        $config = [];
        $configFiles = $configFiles ?: $this->configFiles;
        foreach ($this->modules as $moduleName => $moduleClass) {
            $classParts = explode('\\', $moduleClass);
            array_pop($classParts);
            $moduleDir = implode('/', $classParts);
            $moduleDir = Yii::getAlias('@' . $moduleDir);

            $configData = [];
            foreach ($configFiles as $configName) {
                $configFile = $moduleDir . '/config/' . $configName . '.php';
                if (is_file($configFile)) {
                    $configData[$configName] = include($configFile);
                }
            }

            $config = ArrayHelper::merge($config, $configData);
        }
        return $config;
    }

    public function getClasses()
    {
        $configValues = $this->getConfigValues(['classes']);
        return isset($configValues['classes']) ? $configValues['classes'] : [];
    }

    protected function getDefaultConfig()
    {
        $translations = [];
        $urlRules = [];
        foreach ($this->modules as $moduleName => $moduleClass) {
            $moduleNameParts = explode('_', $moduleName);
            $modulePrefix = reset($moduleNameParts);
            if ($modulePrefix == 'data') {
                continue;
            }
            $shortName = end($moduleNameParts);

            $from = $shortName . '/<controller:.+>/<action:.+>';
            $moduleClassParts = explode('\\', $moduleClass);
            array_pop($moduleClassParts);
            $translations[$moduleName] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => $this->messagePath ?: '@' . implode('/', $moduleClassParts) . '/messages',
                'sourceLanguage' => 'en-US',
                'fileMap' => [
                    $moduleName => $moduleName . '.php',
                ],
            ];

            $to = $moduleName . '/<controller>/<action>';
            $urlRules[$from] = $to;
        }

        return [
            'config' => [
                'components' => [
                    'i18n' => [
                        'translations' => $translations
                    ],
                    'urlManager' => [
                        'rules' => $urlRules
                    ]
                ]
            ],
        ];
    }

    /**
     * sort modules to resolve module dependency
     * @param $modules
     * @return array
     */
    protected function sortModules($modules)
    {
        //sort modules, core module first
        uasort($modules, function ($a, $b) {
            /** @var \kiwi\base\Module $a */
            /** @var \kiwi\base\Module $b */
            if (strpos($a, 'core') === 0 && strpos($b, 'core') !== 0) {
                return -1;
            }
            if (strpos($a, 'core') !== 0 && strpos($b, 'core') === 0) {
                return 1;
            }
            return 0;
        });

        //sort modules, depended module first
        $sortedModules = [];
        foreach ($modules as $moduleName => $moduleClass) {
            if ($moduleClass::$depends) {
                foreach ($moduleClass::$depends as $depend) {
                    if (!isset($sortedModules[$depend])) {
                        if (!isset($modules[$depend])) {
                            Yii::error("Module {$depend} class is not defined, but it is depended by Module {$moduleName}.", __METHOD__);
                            break;
                        }
                        //@TODO there is something wrong
                        $sortedModules[$depend] = $modules[$depend];
                    }
                }
            }
            if (!isset($sortedModules[$moduleName])) {
                $sortedModules[$moduleName] = $moduleClass;
            }
        }
        return $sortedModules;
    }
}