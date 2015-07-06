<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

namespace kiwi\generator;

use kiwi\Kiwi;
use Yii;

class CodeGenerator
{
    public $tab = '    ';

    public function generateArray($file, $array)
    {
        $codeLines = $this->getArrayCode($array);
        array_pop($codeLines);
        array_shift($codeLines);
        $code = implode("\n", $codeLines);

        $php = <<<PHP
<?php
return [
{$code}
];
PHP;
        $file = Yii::getAlias($file);
        file_put_contents($file, $php);
    }

    public function getArrayCode($array)
    {
        $codeLines = ['['];
        foreach ($array as $key => $value) {
            $keyLine = is_int($key) ? '' : $key . ' => ';
            if (!is_array($value)) {
                $valueLine = is_int($value) || is_double($value) ? $value : "'{$value}'";
                $codeLine = $this->tab . $keyLine . $valueLine . ',';
                $codeLines[] = $codeLine;
            } else {
                $codeLines[] = $this->tab . $keyLine . '[';
                $subCodeLines = $this->getArrayCode($value);
                $subCodeLines = array_map(function($v) { return $this->tab . $v; }, $subCodeLines);
                $codeLines = $codeLines + $subCodeLines;
                $codeLines[] = $this->tab . ']';
            }
        }
        $codeLines[] = ']';
        return $codeLines;
    }

    /**
     * @param $ar \yii\db\ActiveRecord
     * @throws \yii\base\InvalidConfigException
     */
    public function generateTable($ar)
    {
        $template = '';
        $columnMap = [
            'varchar' => 'TYPE_STRING . \'',
            'char' => 'TYPE_STRING . \'',
            'text' => 'TYPE_STRING . \'',
            'smallint' => 'TYPE_SMALLINT . \'',
            'mediumint' => 'TYPE_INTEGER . \'',
            'int' => 'TYPE_INTEGER . \'',
            'bigint' => 'TYPE_BIGINT . \'',
            'float' => 'TYPE_FLOAT . \'',
            'decimal' => 'TYPE_DECIMAL . \'',
            'datetime' => 'TYPE_DATETIME . \'',
            'timestamp' => 'TYPE_TIMESTAMP . \'',
            'time' => 'TYPE_TIME . \'',
            'date' => 'TYPE_DATE . \'',
            'blob' => 'TYPE_BINARY . \'',
            'tinyint' => 'TYPE_BOOLEAN . \'',
        ];

        /** @var $ar \yii\db\ActiveRecord */
        $columns = $ar::getTableSchema()->columns;
        foreach ($columns as $column) {
            if ($column->isPrimaryKey) {
                $dbType = strpos($column->dbType, 'bigint') === false ? 'Schema::TYPE_PK' : 'Schema::TYPE_BIGPK';
                $template .= "'{$column->name}' => $dbType, \n";
            } else {
                $dbType = 'Schema::' . strtr($column->dbType, $columnMap);
                $default = $column->defaultValue !== null ? " default \\'{$column->defaultValue}\\'" : '';
                $allowNull = $column->allowNull ? '' : ' NOT NULL';
                $template .= "'{$column->name}' => {$dbType}{$allowNull}{$default}', \n";
            }
        }
        $createTemplate = <<<EOF
\$this->createTable('{$ar::tableName()}', [
    $template
]);\n
EOF;
        echo $createTemplate;
    }

    public function generateTables()
    {
        $exclude = [];
        $tables = [];
        foreach (['singleton', 'class'] as $type) {
            foreach (Kiwi::$classMap[$type] as $key => $class) {
                if (in_array($class, $exclude)) {
                    continue;
                }
                /** @var $class \yii\db\ActiveRecord */
                if (strpos($class, 'models') !== false && strpos($class, 'Form') === false && strpos($class, 'Model') === false && !in_array($class::tableName(), $tables)) {
                    $tables[] = $class::tableName();
                    $this->generateTable($class);
                }
            }
        }
    }
} 