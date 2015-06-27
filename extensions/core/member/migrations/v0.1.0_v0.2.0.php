<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace core\member\migrations;

use kiwi\db\Migration;
use yii\db\Schema;

class v0_1_0_v0_2_0 extends Migration
{
    public function safeUp()
    {
        $this->createTable('statistic_change_record', [
            'statistic_change_record_id' => Schema::TYPE_PK,
            'member_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'type' => Schema::TYPE_SMALLINT . ' NOT NULL',
            'value' => Schema::TYPE_DECIMAL . '(10, 2) NOT NULL',
            'result' => Schema::TYPE_DECIMAL . '(10, 2) NOT NULL',
            'link_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'note' => Schema::TYPE_STRING . ' NOT NULL',
            'create_time' => Schema::TYPE_INTEGER . ' NOT NULL',
            'is_delete' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0'
        ]);
    }

    public function safeDown()
    {

    }
}
