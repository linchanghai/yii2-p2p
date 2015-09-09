<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/14/2014
 * @Time 15:27 AM
 */
namespace core\notification\migrations;

use kiwi\db\Migration;
use yii\db\Schema;

class v0_1_0 extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%notification_template}}', [
            'notification_template_id' => Schema::TYPE_PK,
            'event' => Schema::TYPE_STRING . ' NOT NULL',
            'type' => Schema::TYPE_STRING . ' NOT NULL',
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'template' => Schema::TYPE_STRING . '(1023) NOT NULL',
            'receiver' => Schema::TYPE_STRING . ' NOT NULL',
            'active' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%notification_template}}');
    }
}