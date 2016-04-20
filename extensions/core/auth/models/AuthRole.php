<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/22/2014
 * @Time 3:54 PM
 */

namespace core\auth\models;


use yii\rbac\Role;

class AuthRole extends AuthItem
{
    public static function find()
    {
        return parent::find()->andWhere(['type' => Role::TYPE_ROLE]);
    }
} 