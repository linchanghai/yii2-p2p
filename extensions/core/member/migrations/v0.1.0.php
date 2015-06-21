<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace core\member\migrations;

use kiwi\db\Migration;
use yii\db\Schema;

class v0_1_0 extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%member}}', [
            'member_id' => Schema::TYPE_PK,
            'username' => Schema::TYPE_STRING . '(45) NOT NULL',
            'password_hash' => Schema::TYPE_STRING . '(60) NOT NULL',
            'password_reset_token' => Schema::TYPE_STRING . '(100)',
            'mobile' => Schema::TYPE_STRING . '(11)',
            'email' => Schema::TYPE_STRING . '(60)',
            'email_verify_token' => Schema::TYPE_STRING . '(120)',
            'real_name' => Schema::TYPE_STRING . '(50)',
            'id_card' => Schema::TYPE_STRING . '(18)',
            'recommend_user' => Schema::TYPE_STRING . '(45)',
            'recommend_type' => Schema::TYPE_STRING . '(45)',
            'auth_key' => Schema::TYPE_STRING . '(32)',
            'access_token' => Schema::TYPE_STRING . '(100)',
            'status' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL default \'0\'',
            'update_time' => Schema::TYPE_INTEGER . '(11) NOT NULL default \'0\'',
            'is_deleted' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',
        ]);

        $this->createTable('{{%member_bank}}', [
            'member_bank_id' => Schema::TYPE_PK,
            'member_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'bank_name' => Schema::TYPE_STRING . '(30) NOT NULL',
            'card_no' => Schema::TYPE_STRING . '(25) NOT NULL',
            'bank_user_name' => Schema::TYPE_STRING . '(10) NOT NULL',
            'province' => Schema::TYPE_STRING . '(20) NOT NULL',
            'city' => Schema::TYPE_STRING . '(20) NOT NULL',
            'branch_name' => Schema::TYPE_STRING . '(60) NOT NULL',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'update_time' => Schema::TYPE_INTEGER . '(11)',
            'is_delete' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',
        ]);

        $this->createTable('{{%member_status}}', [
            'member_status_id' => Schema::TYPE_PK,
            'member_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'email_status' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',
            'mobile_status' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',
            'id_card_status' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'update_time' => Schema::TYPE_INTEGER . '(11)',
            'is_delete' => Schema::TYPE_SMALLINT . '(1) default \'0\'',
        ]);

        $this->createTable('{{%member_statistic}}', [
            'member_statistic_id' => Schema::TYPE_PK,
            'member_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'account_money' => Schema::TYPE_DECIMAL . '(9,2) NOT NULL default \'0.00\'',
            'freezon_money' => Schema::TYPE_DECIMAL . '(9,2) NOT NULL default \'0.00\'',
            'package_money' => Schema::TYPE_DECIMAL . '(9,2) NOT NULL default \'0.00\'',
            'package_earning' => Schema::TYPE_DECIMAL . '(9,2) NOT NULL default \'0.00\'',
            'project_total_money' => Schema::TYPE_INTEGER . '(11) default \'0\'',
            'project_earning' => Schema::TYPE_DECIMAL . '(9,2) default \'0.00\'',
            'collect_principal' => Schema::TYPE_DECIMAL . '(9,2) default \'0.00\'',
            'collect_interest' => Schema::TYPE_DECIMAL . '(9,2) NOT NULL default \'0.00\'',
            'points' => Schema::TYPE_INTEGER . '(11) NOT NULL default \'0\'',
            'bonus' => Schema::TYPE_INTEGER . '(11) NOT NULL default \'0\'',
            'used_bonus' => Schema::TYPE_INTEGER . '(11) NOT NULL default \'0\'',
            'empirical_value' => Schema::TYPE_INTEGER . '(11) NOT NULL default \'0\'',
            'is_first_invest' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'update_time' => Schema::TYPE_INTEGER . '(11)',
            'is_delete' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',
        ]);

        $this->createTable('{{%member_coupon}}', [
            'member_coupon_id' => Schema::TYPE_PK,
            'member_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'type' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'value' => Schema::TYPE_STRING . '(45) NOT NULL',
            'used_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'expire_date' => Schema::TYPE_DATETIME . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'update_time' => Schema::TYPE_INTEGER . '(11)',
            'is_delete' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%member}}');
        $this->dropTable('{{%member_bank}}');
        $this->dropTable('{{%member_status}}');
        $this->dropTable('{{%member_statistic}}');
        $this->dropTable('{{%member_coupon}}');
    }
}
