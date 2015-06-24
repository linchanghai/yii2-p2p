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
        $this->createTable('change_log', [
            'change_log_id' => Schema::TYPE_PK,
            'type' => Schema::TYPE_SMALLINT . ' NOT NULL',
            'value' => Schema::TYPE_INTEGER . ' NOT NULL',
            'result' => Schema::TYPE_INTEGER . ' NOT NULL',
            'link_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'note' => Schema::TYPE_STRING . ' NOT NULL',
        ]);
    }

    public function safeDown()
    {

    }
}
