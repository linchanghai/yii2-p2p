<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

namespace kiwi;

use kiwi\db\Migration;
use kiwi\helpers\DirHelper;
use Yii;
use yii\base\BootstrapInterface;
use yii\base\InvalidConfigException;
use yii\base\Object;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;

/**
 * Class Bootstrap
 * @package kiwi
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class Bootstrap extends Object implements BootstrapInterface
{
    /** @var Configuration */
    public $configuration = 'kiwi\Configuration';

    public $initFunctions = [
        'setNamespaces', 'setModules', 'setModuleConfig',
        'setModuleClass', 'setControllerMap', 'setViewPathMap',
        'runModuleMigration', 'generatorAnnotation',
        'runModuleBootstrap',
    ];

    public function bootstrap($app)
    {
        foreach ($this->initFunctions as $func) {
            Yii::beginProfile('Init Kiwi with function ' . $func, __METHOD__);
            $this->$func();
            Yii::endProfile('Init Kiwi with function ' . $func, __METHOD__);
        }
    }

    public function init()
    {
        parent::init();

        Kiwi::registerClass(['singleton' => ['Configuration' => $this->configuration]]);
        $this->configuration = Kiwi::getConfiguration();
    }

    /**
     * set the alias of extension namespace for autoload
     */
    public function setNamespaces()
    {
        $namespaces = $this->configuration->namespaces;
        foreach ($namespaces as $namespace => $namespaceDir) {
            Yii::setAlias($namespace, $namespaceDir);
        }
    }

    /**
     * load module definition and add to yii
     */
    public function setModules()
    {
        Yii::$app->setModules($this->configuration->modules);
    }

    public function setModuleConfig()
    {
        if ($config = $this->configuration->defaultConfig['config']) {
            if (isset($config['components'])) {
                $components = ArrayHelper::merge(Yii::$app->getComponents(), $config['components']);
                if (isset($components['errorHandler'])) {
                    unset($components['errorHandler']);
                }
                Yii::$app->setComponents($components);
            }

            $keys = ['modules', 'controllerMap', 'params'];
            foreach ($keys as $key) {
                if (isset($config[$key])) {
                    Yii::$app->$key = ArrayHelper::merge(Yii::$app->$key, $config[$key]);
                }
            }
        }

        if ($config = $this->configuration->config) {
            if (isset($config['components'])) {
                $components = ArrayHelper::merge(Yii::$app->getComponents(), $config['components']);
                if (isset($components['errorHandler'])) {
                    unset($components['errorHandler']);
                }
                Yii::$app->setComponents($components);
            }

            $keys = ['modules', 'controllerMap', 'params'];
            foreach ($keys as $key) {
                if (isset($config[$key])) {
                    Yii::$app->$key = ArrayHelper::merge(Yii::$app->$key, $config[$key]);
                }
            }

            if (isset($config[Yii::$app->id])) {
                $config = $config[Yii::$app->id];
                if (isset($config['components'])) {
                    $components = ArrayHelper::merge(Yii::$app->getComponents(), $config['components']);
                    if (isset($components['errorHandler'])) {
                        unset($components['errorHandler']);
                    }
                    Yii::$app->setComponents($components);
                }

                $keys = ['modules', 'controllerMap', 'params'];
                foreach ($keys as $key) {
                    if (isset($config[$key])) {
                        Yii::$app->$key = ArrayHelper::merge(Yii::$app->$key, $config[$key]);
                    }
                }
            }
        }
    }

    public function setModuleClass()
    {
        if ($classes = $this->configuration->classes) {
            Kiwi::registerClass($classes);

            if (isset($classes[Yii::$app->id])) {
                Kiwi::registerClass($classes[Yii::$app->id]);
            }
        }
    }

    public function setControllerMap()
    {
        if ($controllers = $this->configuration->controllers) {
            if (isset($controllers[Yii::$app->id])) {
                $controllerMap = $controllers[Yii::$app->id];
                Yii::$app->controllerMap = ArrayHelper::merge(Yii::$app->controllerMap, $controllerMap);
            }

            foreach ($this->configuration->modules as $moduleName => $moduleClass) {
                if (isset($controllers[$moduleName]) && isset($controllers[$moduleName][Yii::$app->id])) {
                    $controllerMap = $controllers[$moduleName][Yii::$app->id];
                    $module = Yii::$app->getModule($moduleName);
                    $module->controllerMap = ArrayHelper::merge($module->controllerMap, $controllerMap);
                }
            }
        }
    }

    public function setViewPathMap()
    {
        if ($views = $this->configuration->views) {
            if (isset($views[Yii::$app->id])) {
                $views = $views[Yii::$app->id];
                $themes = isset(Yii::$app->params['KiwiThemes']) ? Yii::$app->params['KiwiThemes'] : [];
                if (is_string($themes)) {
                    $themes = [$themes];
                }

                array_push($themes, 'default');
                foreach ($themes as $theme) {
                    if (isset($views[$theme])) {
                        $this->setThemePathMap($views[$theme]);
                    }
                }
            }
        }
    }

    public function runModuleMigration()
    {
        foreach ($this->configuration->modules as $moduleName => $moduleClass) {
            $dataVersion = $this->getModuleDataVersion($moduleName);
            if ($dataVersion && $dataVersion == $moduleClass::$version) {
                continue;
            }

            $classParts = explode('\\', $moduleClass);
            array_pop($classParts);
            $moduleNameSpace = implode('\\', $classParts);
            $moduleDir = implode('/', $classParts);
            $moduleDir = Yii::getAlias('@' . $moduleDir);

            //get migration files
            $migrationDir = $moduleDir . '/migrations';

            if (!is_dir($migrationDir))
                continue;

            $migrationFiles = FileHelper::findFiles($migrationDir);
            if (!$migrationFiles)
                continue;

            $migrationVersions = array_map(function ($fileName) {
                $fileName = end(explode(DIRECTORY_SEPARATOR, $fileName));
                $fileName = explode('.', $fileName);
                array_pop($fileName);
                return implode('.', $fileName);
            }, $migrationFiles);

            $installVersion = '';
            $upgradeVersions = [];
            //get version list
            foreach ($migrationVersions as $migrationVersion) {
                if (strpos($migrationVersion, '_') === false) {
                    $installVersion = $migrationVersion;
                } else {
                    $migrationVersion = explode('_', $migrationVersion);
                    $upgradeVersions[$migrationVersion[0]] = $migrationVersion[1];
                }
            }

            //if not install, find install file and run
            if (!$dataVersion && $installVersion) {
                include($migrationDir . '/' . $installVersion . '.php');
                $class = $moduleNameSpace . '\\migrations\\' . str_replace('.', '_', $installVersion);
                /** @var \kiwi\db\Migration $migration */
                $migration = new $class(['module' => $moduleName]);
                $migration->up();
                $dataVersion = $installVersion;
                Yii::info("Module {$moduleName} version $dataVersion installed");
            }
            //if has upgrade version, run upgrade
            while (isset($upgradeVersions[$dataVersion])) {
                include($migrationDir . '/' . $dataVersion . '_' . $upgradeVersions[$dataVersion] . '.php');
                $class = $moduleNameSpace . '\\migrations\\' . str_replace('.', '_', $dataVersion . '_' . $upgradeVersions[$dataVersion]);
                /** @var \kiwi\db\Migration $migration */
                $migration = new $class(['module' => $moduleName]);
                $migration->up();
                $dataVersion = $upgradeVersions[$dataVersion];
                Yii::info("Module {$moduleName} version $dataVersion upgraded");
            }
        }
    }

    public function runModuleBootstrap()
    {
        foreach ($this->configuration->modules as $moduleName => $moduleClass) {
            foreach ($moduleClass::$bootstrap as $class) {
                $component = null;
                if (is_string($class)) {
                    if (Yii::$app->has($class)) {
                        $component = Yii::$app->get($class);
                    } elseif (Yii::$app->hasModule($class)) {
                        $component = Yii::$app->getModule($class);
                    } elseif (strpos($class, '\\') === false) {
                        throw new InvalidConfigException("Unknown bootstrapping component ID: $class");
                    }
                }
                if (!isset($component)) {
                    $component = Yii::createObject($class);
                }

                if ($component instanceof BootstrapInterface) {
                    Yii::trace("Bootstrap with " . get_class($component) . '::bootstrap()', __METHOD__);
                    $component->bootstrap(Yii::$app);
                } else {
                    Yii::trace("Bootstrap with " . get_class($component), __METHOD__);
                }
            }
        }
    }

    protected function setThemePathMap($viewPathMap)
    {
        if (!($theme = Yii::$app->getView()->theme)) {
            $theme = Yii::$app->getView()->theme = Yii::createObject(['class' => 'yii\base\Theme', 'basePath' => '@app/views']);
        }
        if (isset($viewPathMap['baseUrl']) && $viewPathMap['baseUrl']) {
            $theme->setBaseUrl($viewPathMap['baseUrl']);
        }
        if (isset($viewPathMap['basePath']) && $viewPathMap['basePath']) {
            $theme->setBasePath($viewPathMap['basePath']);
        }
        if (isset($viewPathMap['pathMap']) && $viewPathMap['pathMap']) {
            foreach ($viewPathMap['pathMap'] as $from => $to) {
                $to = is_string($to) ? array_reverse([$to]) : array_reverse($to);
                if (isset($theme->pathMap[$from])) {
                    if (!is_array($theme->pathMap[$from])) {
                        $theme->pathMap[$from] = [$theme->pathMap[$from]];
                    }
                    if (is_array($to)) {
                        $theme->pathMap[$from] = ArrayHelper::merge($theme->pathMap[$from], $to);
                    } else if (!in_array($to, $theme->pathMap[$from])) {
                        $theme->pathMap[$from][] = $to;
                    }
                } else {
                    $theme->pathMap[$from] = is_array($to) ? $to : [$to];
                }
            }
        }
    }

    private $_moduleVersions;

    public function getModuleDataVersion($module)
    {
        if (!$this->_moduleVersions) {
            /** @var Migration $migration */
            $migration = Yii::createObject(Migration::className());
            $this->_moduleVersions = $migration->getVersions();
        }
        return isset($this->_moduleVersions[$module]) ? $this->_moduleVersions[$module] : null;
    }

    public function generatorAnnotation()
    {
        if (YII_DEBUG) {
            /** @var \kiwi\generator\AnnotationGenerator $annotationGenerator */
            $annotationGenerator = Yii::createObject('kiwi\generator\AnnotationGenerator');
            $annotationGenerator->generate();
        }
    }
}