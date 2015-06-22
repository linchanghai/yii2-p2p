<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace p2p\activity\migrations;

use kiwi\db\Migration;
use yii\db\Schema;

class v0_1_0 extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%project_invest_empiric_record}}', [
            'project_invest_empiric_record_id' => Schema::TYPE_PK,
            'project_invest_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'project_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'member_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'empiric_value' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'is_delete' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',
        ]);

        $this->createTable('{{%coupon_annual_record}}', [
            'coupon_annual_record_id' => Schema::TYPE_PK,
            'project_invest_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'project_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'member_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'member_coupon_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'rate' => Schema::TYPE_DECIMAL . '(8,2) NOT NULL',
            'interst_money' => Schema::TYPE_DECIMAL . '(8,2) NOT NULL',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'is_delete' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',

        ]);
        $this->createTable('{{%coupon_bonus_record}}', [
            'coupon_bonus_record_id' => Schema::TYPE_PK,
            'project_invest_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'project_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'member_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'discount_money' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'is_delete' => Schema::TYPE_SMALLINT . '(1) NOT NULL',

        ]);
        $this->createTable('{{%coupon_cash_record}}', [
            'coupon_cash_record_id' => Schema::TYPE_PK,
            'project_invest_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'project_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'member_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'member_coupon_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'discount_money' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'is_delete' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',

        ]);
        $this->createTable('{{%member_sign_record}}', [
            'member_sign_record_id' => Schema::TYPE_PK,
            'member_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'target_date' => Schema::TYPE_STRING . '(8) NOT NULL',
            'ponit' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'is_delete' => Schema::TYPE_SMALLINT . '(1) NOT NULL',

        ]);
    }

    public function safeDown()
    {

    }
}
