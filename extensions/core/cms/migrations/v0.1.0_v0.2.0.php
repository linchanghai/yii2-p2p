<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/14/2014
 * @Time 15:27 AM
 */
namespace core\cms\migrations;

use kiwi\db\Migration;
use kiwi\Kiwi;

class v0_1_0_v0_2_0 extends Migration
{
    public function safeUp()
    {
        $this->insert('{{%tree}}', [
            'name' => 'default',
            'root' => 0,
            'lft' => 1,
            'rgt' => 2,
            'level' => 1,
            'type' => 'articleCategory',
        ]);
    }

    public function safeDown()
    {
        $this->delete('{{%tree}}', ['type' => 'articleCategory']);
    }
}
