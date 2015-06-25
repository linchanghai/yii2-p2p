<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace p2p\recharge\migrations;

use kiwi\db\Migration;
use yii\db\Schema;

class v0_1_0 extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%recharge_record}}', [
            'recharge_record_id' => Schema::TYPE_PK,
            'transaction_id' => Schema::TYPE_STRING . '(30) NOT NULL',
            'member_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'money' => Schema::TYPE_DECIMAL . '(9,2) NOT NULL',
            'recharge_type' => Schema::TYPE_SMALLINT . '(1) NOT NULL',
            'use_for_type' => Schema::TYPE_SMALLINT . ' NOT NULL default 0',
            'use_for_id' => Schema::TYPE_INTEGER . '(11) NOT NULL default \'0\'',
            'status' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'update_time' => Schema::TYPE_INTEGER . '(11)',
            'is_delete' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',
        ]);
    }

    public function safeDown()
    {

    }
}
