<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace p2p\project\migrations;

use kiwi\db\Migration;
use yii\db\Schema;

class v0_1_0 extends Migration
{
    public function safeUp()
    {
        $this->createTable('project', [
            'project_id' => Schema::TYPE_PK,
            'project_name' => Schema::TYPE_STRING . '(100) NOT NULL',
            'project_no' => Schema::TYPE_STRING . '(30) NOT NULL',
            'invest_total_money' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'interest_rate' => Schema::TYPE_DECIMAL . '(3,2) NOT NULL',
            'repayment_date' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'repayment_type' => Schema::TYPE_SMALLINT . '(1) NOT NULL',
            'release_date' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'project_type' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',
            'create_user' => Schema::TYPE_STRING . '(45) NOT NULL',
            'invested_money' => Schema::TYPE_INTEGER . '(11) NOT NULL default \'0\'',
            'total_invest_money' => Schema::TYPE_INTEGER . '(11) NOT NULL default \'0\'',
            'verify_user' => Schema::TYPE_STRING . '(45)',
            'verify_date' => Schema::TYPE_INTEGER . '(11)',
            'min_money' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'status' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'update_time' => Schema::TYPE_INTEGER . '(11)',
            'is_delete' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',
        ]);

        $this->createTable('project_details', [
            'project_details_id' => Schema::TYPE_PK,
            'project_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'project_introduce' => Schema::TYPE_STRING . '(256) NOT NULL',
            'loan_person_info' => Schema::TYPE_STRING . '(150) NOT NULL',
            'repayment_source' => Schema::TYPE_STRING . ' NOT NULL',
            'collateral_info' => Schema::TYPE_STRING . ' NOT NULL',
            'risk_control_info' => Schema::TYPE_STRING . ' NOT NULL',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'update_time' => Schema::TYPE_INTEGER . '(11)',
            'is_delete' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',
        ]);

        $this->createTable('project_invest_empiric_record', [
            'project_invest_empiric_id' => Schema::TYPE_PK,
            'project_invest_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'project_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'member_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'empiric_value' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'is_delete' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',
        ]);

        $this->createTable('project_invest', [
            'project_invest_id' => Schema::TYPE_PK,
            'project_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'member_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'rate' => Schema::TYPE_DECIMAL . '(3,2) NOT NULL default \'0.00\'',
            'invest_money' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'interest_money' => Schema::TYPE_DECIMAL . '(10,2) NOT NULL',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'update_time' => Schema::TYPE_INTEGER . '(11)',
            'status' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',
            'is_delete' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',
            'actual_invest_money' => Schema::TYPE_INTEGER . '(11) NOT NULL default \'0\'',
        ]);

        $this->createTable('project_legal_opinion', [
            'project_legal_opinion_id' => Schema::TYPE_PK,
            'project_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'legal_info' => Schema::TYPE_STRING . ' NOT NULL',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'update_time' => Schema::TYPE_INTEGER . '(11)',
            'is_delete' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',
        ]);

        $this->createTable('project_material', [
            'project_material_id' => Schema::TYPE_PK,
            'project_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'material' => Schema::TYPE_STRING . ' NOT NULL',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'update_time' => Schema::TYPE_INTEGER . '(11)',
            'is_delete' => Schema::TYPE_SMALLINT . '(1) unsigned NOT NULL default \'0\'',
        ]);
        $this->createTable('project_repayment', [
            'project_repayment_id' => Schema::TYPE_PK,
            'project_invest_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'project_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'member_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'interest_money' => Schema::TYPE_DECIMAL . '(8,2) NOT NULL',
            'invest_money' => Schema::TYPE_INTEGER . '(11) NOT NULL default \'0\'',
            'repayment_date' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'status' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',
            'is_transfer' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'update_time' => Schema::TYPE_INTEGER . '(11)',
            'is_delete' => Schema::TYPE_SMALLINT . '(1) default \'0\'',
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%project}}');
        $this->dropTable('{{%project_details}}');
        $this->dropTable('{{%project_invest_empiric_record}}');
        $this->dropTable('{{%project_invest}}');
        $this->dropTable('{{%project_legal_opinion}}');
        $this->dropTable('{{%project_material}}');
        $this->dropTable('{{%project_repayment}}');
    }
}
