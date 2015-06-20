<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 * @Date 6/6/2015
 * @Time 3:56 PM
 */

return [
    'components' => [
        'user' => [
            'identityClass' => 'core\admin\models\Admin',
            'enableAutoLogin' => true,
        ],
    ],
];