<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

namespace kiwi\generator;


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
} 