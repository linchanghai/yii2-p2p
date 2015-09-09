<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/14/2014
 * @Time 15:27 AM
 */
namespace core\system\migrations;

use kiwi\db\Migration;
use yii\db\Schema;

class v0_1_0 extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%setting}}', [
            'setting_id' => Schema::TYPE_PK,
            'key' => Schema::TYPE_STRING . ' NOT NULL',
            'value' => Schema::TYPE_STRING . '(1023) NOT NULL',
        ]);

        $this->createTable('{{%data_list}}', [
            'data_list_id' => Schema::TYPE_PK,
            'type' => Schema::TYPE_STRING . ' NOT NULL',
            'key' => Schema::TYPE_STRING . ' NOT NULL',
            'value' => Schema::TYPE_STRING . '(1023) NOT NULL',
            'is_removed' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%setting}}');
        $this->dropTable('{{%data_list}}');
    }
}
