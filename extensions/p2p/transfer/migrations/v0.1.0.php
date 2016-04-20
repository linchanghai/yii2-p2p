<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace p2p\transfer\migrations;

use kiwi\db\Migration;
use yii\db\Schema;

class v0_1_0 extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%project_invest_transfer_apply}}', [
            'project_invest_transfer_apply_id' => Schema::TYPE_PK,
            'project_invest_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'project_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'member_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'min_money' => Schema::TYPE_INTEGER . '(11) NOT NULL default \'0\'',
            'total_invest_money' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'discount_rate' => Schema::TYPE_DECIMAL . '(4,2) NOT NULL default \'0.00\'',
            'status' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',
            'verify_user' => Schema::TYPE_STRING . '(80)',
            'verify_date' => Schema::TYPE_INTEGER . '(11)',
            'counter_fee' => Schema::TYPE_DECIMAL . '(8,2) NOT NULL default \'0.00\'',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'update_time' => Schema::TYPE_INTEGER . '(11)',
            'is_delete' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',
        ]);

        $this->createTable('{{%project_transfer_discount_record}}', [
            'project_transfer_discount_record_id' => Schema::TYPE_PK,
            'project_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'project_invest_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'member_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'rate' => Schema::TYPE_DECIMAL . '(4,2) NOT NULL default \'0.00\'',
            'discount_money' => Schema::TYPE_DECIMAL . '(8,2) NOT NULL default \'0.00\'',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'is_delete' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',
        ]);
    }

    public function safeDown()
    {

    }
}
