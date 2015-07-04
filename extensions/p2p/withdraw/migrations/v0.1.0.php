<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace p2p\withdraw\migrations;

use kiwi\db\Migration;
use yii\db\Schema;

class v0_1_0 extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%deposit_record}}', [
            'deposit_record_id' => Schema::TYPE_PK,
            'member_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'money' => Schema::TYPE_DECIMAL . '(9,2) NOT NULL',
            'counter_fee' => Schema::TYPE_DECIMAL . '(9,2) NOT NULL',
            'deposit_type' => Schema::TYPE_STRING . '(45)',
            'first_verify_user' => Schema::TYPE_STRING . '(80)',
            'first_verify_date' => Schema::TYPE_INTEGER . '(11)',
            'second_verify_user' => Schema::TYPE_STRING . '(80)',
            'second_verify_date' => Schema::TYPE_INTEGER . '(11)',
            'status' =>  Schema::TYPE_INTEGER . '(11)',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'update_time' => Schema::TYPE_INTEGER . '(11)',
            'is_delete' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%deposit_record}}');
    }
}
