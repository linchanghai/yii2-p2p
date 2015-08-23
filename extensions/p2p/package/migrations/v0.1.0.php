<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace p2p\package\migrations;

use kiwi\db\Migration;
use yii\db\Schema;

class v0_1_0 extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%package_interest_record}}', [
            'package_interest_record_id' => Schema::TYPE_PK,
            'member_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'daily_interest' => Schema::TYPE_DECIMAL . '(9,2) NOT NULL',
            'target_date' => Schema::TYPE_STRING . '(8) NOT NULL',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'is_delete' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',

        ]);
        $this->createTable('{{%package_record}}', [
            'package_record_id' => Schema::TYPE_PK,
            'member_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'exchange_cash' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'type' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'is_delete' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',

        ]);
    }

    public function safeDown()
    {

    }
}
