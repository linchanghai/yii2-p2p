<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 6/6/2015
 * @Time 4:10 PM
 */

namespace core\admin\models;

use core\user\models\User;

/**
 * Class Admin
 * @package core\admin\models\Admin
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 */
class Admin extends User
{
    const ROLE_USER = 2;
}