<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/14/2014
 * @Time 15:27 AM
 */
namespace core\message\migrations;

use kiwi\db\Migration;
use yii\db\Schema;

class v0_1_0 extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%message}}', [
            'message_id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'content' => Schema::TYPE_STRING . '(1023) NOT NULL',
            'from' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'to' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'status' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%message}}');
    }
}
