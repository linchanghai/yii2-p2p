<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/14/2014
 * @Time 15:27 AM
 */
namespace core\category\migrations;

use kiwi\db\Migration;
use kiwi\Kiwi;
use yii\db\Schema;

class v0_1_0 extends Migration
{
    public function safeUp()
    {
        $this->insert('{{%tree}}', [
            'name' => 'default',
            'root' => 0,
            'lft' => 1,
            'rgt' => 2,
            'level' => 1,
            'type' => 'category',
        ]);
    }

    public function safeDown()
    {
        $this->delete('{{%tree}}', ['type' => 'category']);
    }
}
