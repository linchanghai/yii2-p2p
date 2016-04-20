<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/14/2014
 * @Time 15:27 AM
 */
namespace core\system\migrations;

use kiwi\db\Migration;
use yii\db\Schema;

class v0_2_0_v0_3_0 extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%menu}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'root' => Schema::TYPE_INTEGER . ' NOT NULL',
            'lft' => Schema::TYPE_INTEGER . ' NOT NULL',
            'rgt' => Schema::TYPE_INTEGER . ' NOT NULL',
            'level' => Schema::TYPE_INTEGER . ' NOT NULL',
            'type' => Schema::TYPE_STRING . ' NOT NULL',
            'url' => Schema::TYPE_STRING . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1',
        ]);

        $this->insert('{{%menu}}', [
            'name' => 'Home',
            'root' => 0,
            'lft' => 1,
            'rgt' => 2,
            'level' => 1,
            'type' => 'menu',
            'url' => 'site/index',
            'status' => 1,
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%url_rewrite}}');
    }
}
