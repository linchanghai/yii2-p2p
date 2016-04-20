<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace core\admin\migrations;

use kiwi\db\Migration;
use kiwi\Kiwi;

class v0_1_0 extends Migration
{
    public function safeUp()
    {
        $admin = Kiwi::getAdmin();
        $admin->username = 'admin';
        $admin->setPassword('admin123');
        $admin->generateAuthKey();
        $admin->save();
    }

    public function safeDown()
    {
        $adminClass = Kiwi::getAdminClass();
        $adminClass::deleteAll(['username' => 'admin', 'role' => $adminClass::ROLE_USER]);
    }
}
