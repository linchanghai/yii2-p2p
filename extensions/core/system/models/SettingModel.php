<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 * @Date 5/28/2015
 * @Time 1:02 PM
 */

namespace core\system\models;


use kiwi\helpers\CheckHelper;
use kiwi\Kiwi;
use kiwi\models\KeyValueModel;
use Yii;
use yii\bootstrap\Collapse;
use yii\bootstrap\Tabs;
use yii\helpers\ArrayHelper;

class SettingModel extends KeyValueModel
{
    public $modelClass = 'core\system\models\Setting';

    public $keySeparator = '_';

    public function getDefinition()
    {
        $definition = [];
        $config = Kiwi::getConfiguration()->settings;
        foreach ($config as $tabKey => $tab) {
            foreach ($tab['groups'] as $groupKey => $group) {
                foreach ($group['fields'] as $fieldKey => $field) {
                    $settingKey = $this->getSettingKey($tabKey, $groupKey, $fieldKey);
                    $definition[$settingKey] = $field;
                }
            }
        }
        return $definition;
    }

    /**
     * get the config
     * @param \yii\bootstrap\ActiveForm $form
     * @param array $options
     * @return string
     */
    public function renderForm($form, $options = [])
    {
        if (!$options) {
            $template = "{label}\n<div class=\"col-sm-11\">{input}\n<div style=\"width:60%\">{hint}\n</div>{error}</div>";
            $labelOptions = ['class' => 'control-label col-sm-1'];
            $options = ['template' => $template, 'labelOptions' => $labelOptions, 'inputOptions' => ['class' => 'form-control', 'style' => 'width: 50%']];
        }

        $config = Kiwi::getConfiguration()->settings;
        $tabItems = [];
        foreach ($config as $tabKey => $tab) {
            $groupItems = [];
            foreach ($tab['groups'] as $groupKey => $group) {
                $groupContent = '';
                foreach ($group['fields'] as $fieldKey => $field) {
                    $dataOptions = [];
                    if (isset($field['depend'])) {
                        list($dependKey, $dependValue) = $field['depend'];
                        $dataOptions = [
                            'depend-key' => $dependKey,
                            'depend-value' => $dependValue,
                        ];
                    }
                    $fieldOptions = array_merge($options, ['options' => ['class' => 'form-group', 'data' => $dataOptions]]);

                    $key = $this->getSettingKey($tabKey, $groupKey, $fieldKey);
                    /** @var \yii\bootstrap\ActiveField $activeField */
                    $activeField = $form->field($this, $key, $fieldOptions);

                    $dataList = isset($field[$this->dataListKey]) ? $field[$this->dataListKey] : [];
                    $dataList = isset($field[$this->dataSourceKey]) && CheckHelper::isCallable($field[$this->dataSourceKey])
                        ? ArrayHelper::merge($dataList, call_user_func($field[$this->dataSourceKey])) : $dataList;

                    switch ($field[$this->inputTypeKey]) {
                        case 'checkbox':
                            $activeField->inline()->checkboxList($dataList);
                            break;
                        case 'radio':
                            $activeField->inline()->radioList($dataList);
                            break;
                        case 'select':
                            $activeField->dropDownList($dataList);
                            break;
                        case 'textarea':
                            $activeField->textarea();
                            break;
                        case 'password':
                            $activeField->passwordInput();
                            break;
                    }
                    if (isset($field['hint'])) {
                        $activeField->hint($field['hint']);
                    }
                    $groupContent .= $activeField->render();
                }

                $groupItems[$group['label']] = [
                    'label' => $group['label'],
                    'content' => $groupContent,
                ];
            }
            $tabContent = Collapse::widget(['items' => $groupItems]);
            $tabItems[] = [
                'label' => $tab['label'],
                'content' => $tabContent,
            ];
        }

        $js = <<<JS
var modelName = 'SettingModel'
$(document).on('change', 'select, input[type=checkbox], input[type=radio]', function() {
    var name = $(this).attr('name')
    var dataKey = name.substring(modelName.length + 1, name.length - 1);
    var dataValue = $(this).val();
    if ($('[data-depend-key='+dataKey+']').length) {
        $('[data-depend-key='+dataKey+']').hide();
    }
    if ($('[data-depend-key='+dataKey+'][data-depend-value='+dataValue+']').length) {
        $('[data-depend-key='+dataKey+'][data-depend-value='+dataValue+']').show();
    }
});

$('[data-depend-key]').each(function() {
    var input = $(this);
    var valueInput = $('[name="'+modelName+'['+input.data('depend-key')+']"]');
    if (valueInput.val() == input.data('depend-key')) {
        input.show();
    } else {
        input.hide();
    }
});
JS;

        Yii::$app->view->registerJs($js);

        return Tabs::widget(['items' => $tabItems]);
    }

    /**
     * @param $tabKey
     * @param $groupKey
     * @param $fieldKey
     * @return string
     */
    public function getSettingKey($tabKey, $groupKey, $fieldKey)
    {
        return $fieldKey;
        return implode($this->keySeparator, [$tabKey, $groupKey, $fieldKey]);
    }
}