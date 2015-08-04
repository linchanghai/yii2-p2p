<?php
/**
 * @copyright Copyright (c) 2015 Kiwi
 */

use kiwi\Kiwi;

return [
    'components' => [
        'setting' => Kiwi::getSettingModelClass(),
        'dataList' => Kiwi::getDataListModelClass(),
    ],
];