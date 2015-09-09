<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace core\user\migrations;

use kiwi\db\Migration;
use yii\db\Schema;

class v0_1_0 extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'user_id' => Schema::TYPE_PK,
            'username' => Schema::TYPE_STRING . ' NOT NULL',
            'password_hash' => Schema::TYPE_STRING . ' NOT NULL',
            'password_reset_token' => Schema::TYPE_STRING,
            'email' => Schema::TYPE_STRING . ' NOT NULL',
            'email_verify_token' => Schema::TYPE_STRING,
            'phone' => Schema::TYPE_STRING . '(11) NOT NULL',

            'auth_key' => Schema::TYPE_STRING . '(32) NOT NULL',
            'access_token' => Schema::TYPE_STRING . ' NOT NULL',

            'role' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
