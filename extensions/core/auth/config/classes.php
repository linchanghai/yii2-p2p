<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/15/2014
 * @Time 10:28 AM
 */

return [
    'singleton' => [],
    'class' => [
        'AuthItem' => 'core\auth\models\AuthItem',
        'AuthRole' => 'core\auth\models\AuthRole',
        'AuthRule' => 'core\auth\models\AuthRule',
        'UserModel' => 'core\auth\models\UserModel',
        'RoleModel' => 'core\auth\models\RoleModel',
        'actionAccessRule' => 'core\auth\filters\ActionAccessRule',
    ],
];