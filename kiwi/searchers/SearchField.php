<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

namespace kiwi\searchers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveField;

/**
 * Class SearchField
 * @package kiwi\searchers
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class SearchField extends ActiveField
{
    public $template = "{label}\n{input}\n{hint}\n{error}\n<div class=\"clearfix\"></div>";
    /**
     * @var \yii\db\ActiveRecord the data model that this field is associated with
     */
    public $model;

    #region override

    public function begin()
    {
        $inputID = Html::getInputId($this->model, $this->attribute);
        $attribute = Html::getAttributeName($this->attribute);
        $options = $this->options;
        $class = isset($options['class']) ? [$options['class']] : [];
        $class[] = "field-$inputID";
        $options['class'] = implode(' ', $class);
        $tag = ArrayHelper::remove($options, 'tag', 'div');

        return Html::beginTag($tag, $options);
    }

    #endregion

    #region extend input

    public function rangeInput($options = [])
    {
        $options = array_merge($this->inputOptions, $options);
        $this->adjustLabelFor($options);

        $values = $this->model->getQueryParam($this->attribute);
        $option1 = array_merge($options, [
            'id' => Html::getInputId($this->model, $this->attribute) . '-min',
            'name' => Html::getInputName($this->model, $this->attribute) . '[min]',
            'value' => isset($values['min']) ? $values['min'] : '',
        ]);
        $option2 = array_merge($options, [
            'id' => Html::getInputId($this->model, $this->attribute) . '-max',
            'name' => Html::getInputName($this->model, $this->attribute) . '[max]',
            'value' => isset($values['max']) ? $values['max'] : '',
        ]);

        $this->template = "{label}\n{input1}<span style='float: left; margin: 0 20px'>--</span>{input2}\n{hint}\n{error}\n<div class=\"clearfix\"></div>";
        $this->parts['{input}'] = '';
        $this->parts['{input1}'] = Html::activeTextInput($this->model, $this->attribute, $option1);
        $this->parts['{input2}'] = Html::activeTextInput($this->model, $this->attribute, $option2);

        return $this;
    }

    public function dateInput($options = [])
    {
        $this->registerDateInputAsset();

        $options = array_merge($this->inputOptions, $options);
        $this->adjustLabelFor($options);

        $this->template = '{label}<div class="col-sm-2 input-group date form_datetime" data-date="' . date('Y-m-dTH:i:s') . 'T" data-date-format="dd/MM/yyyy" data-link-field="dtp_input1">{input}
<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span></div>{hint}{error}<div class="clearfix"></div>';
//        $options['class'] = isset($options['class']) ? $options['class'] . ' date form_datetime' : 'date form_datetime'
//        $options['data-date'] = date('Y-m-dTH:i:s');
//        $options['data-date-format'] = 'dd/MM/yyyy - hh:ii:ss';
        $this->parts['{input}'] = Html::activeTextInput($this->model, $this->attribute, $options);

        return $this;
    }

    public function dateRangeInput($options = [])
    {
        $this->registerDateInputAsset();

        $options = array_merge($this->inputOptions, $options);
        $this->adjustLabelFor($options);

        $input1 = '<div class="col-sm-2 input-group date form_datetime" style="float:left" data-date="' . date('Y-m-dTH:i:s') .'" data-date-format="dd/MM/yyyy" data-link-field="dtp_input1">{input1}
<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span></div>';
        $input2 = '<div class="col-sm-2 input-group date form_datetime" style="float:left" data-date="' . date('Y-m-dTH:i:s') . 'T" data-date-format="dd/MM/yyyy" data-link-field="dtp_input1">{input2}
<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span></div>';
        $this->template = "{label}{$input1}<span style='float: left; margin: 0 20px'>--</span>{$input2}{hint}{error}\n<div class=\"clearfix\"></div>";

        $values = $this->model->getQueryParam($this->attribute);
        $option1 = array_merge($options, [
            'id' => Html::getInputId($this->model, $this->attribute) . '-min',
            'name' => Html::getInputName($this->model, $this->attribute) . '[min]',
            'value' => isset($values['min']) ? $values['min'] : '',
        ]);
        $option2 = array_merge($options, [
            'id' => Html::getInputId($this->model, $this->attribute) . '-max',
            'name' => Html::getInputName($this->model, $this->attribute) . '[max]',
            'value' => isset($values['max']) ? $values['max'] : '',
        ]);

        $this->parts['{input}'] = '';
        $this->parts['{input1}'] = Html::activeTextInput($this->model, $this->attribute, $option1);
        $this->parts['{input2}'] = Html::activeTextInput($this->model, $this->attribute, $option2);

        return $this;
    }

    protected function registerDateInputAsset()
    {
        $js = <<<EOF
        $('.form_datetime').datetimepicker({
            language: 'zh-CN',
//            minView: "month",
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1,
            format: "yyyy/m/d HH:ii:ss",
            linkFormat: "yyyy/m/d HH:ii:ss"
        });
EOF;
        Yii::$app->view->registerJs($js);
        Yii::$app->view->registerCssFile(Yii::$app->urlManager->baseUrl . '/css/bootstrap-datetimepicker.min.css');
        Yii::$app->view->registerJsFile(Yii::$app->urlManager->baseUrl . '/js/bootstrap-datetimepicker.js', ['depends' => \yii\bootstrap\BootstrapPluginAsset::className()]);
        Yii::$app->view->registerJsFile(Yii::$app->urlManager->baseUrl . '/js/bootstrap-datetimepicker.zh-CN.js', ['depends' => \yii\bootstrap\BootstrapPluginAsset::className()]);
    }

    #endregion
} 