<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace core\cms\migrations;

use kiwi\db\Migration;
use yii\db\Schema;

class v0_1_0 extends Migration
{
    public function safeUp()
    {
        $this->createTable('cms_about', [
            'cms_about_id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . '(100)',
            'content' => Schema::TYPE_STRING . ' NOT NULL',
            'img' => Schema::TYPE_STRING . '(100)',
            'type' => Schema::TYPE_BOOLEAN . '(1) NOT NULL',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'update_time' => Schema::TYPE_INTEGER . '(11)',
            'create_by' => Schema::TYPE_STRING . '(45) NOT NULL',
            'update_by' => Schema::TYPE_STRING . '(45)',
            'is_delete' => Schema::TYPE_BOOLEAN . '(1) NOT NULL default \'0\'',

        ]);
        $this->createTable('cms_contact', [
            'cms_contact_id' => Schema::TYPE_PK,
            'address' => Schema::TYPE_STRING . '(200) NOT NULL',
            'phone' => Schema::TYPE_STRING . '(100) NOT NULL',
            'qq' => Schema::TYPE_STRING . '(45) NOT NULL',
            'weibo' => Schema::TYPE_STRING . '(200) NOT NULL',
            'weixin' => Schema::TYPE_STRING . '(100) NOT NULL',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'update_time' => Schema::TYPE_INTEGER . '(11)',
            'create_by' => Schema::TYPE_STRING . '(45) NOT NULL',
            'update_by' => Schema::TYPE_STRING . '(45)',
            'is_delete' => Schema::TYPE_BOOLEAN . '(1) NOT NULL default \'0\'',

        ]);
        $this->createTable('cms_help', [
            'cms_help_id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . '(45) NOT NULL',
            'content' => Schema::TYPE_STRING . ' NOT NULL',
            'type' => Schema::TYPE_BOOLEAN . '(1) NOT NULL default \'0\'',
            'create_by' => Schema::TYPE_STRING . '(45) NOT NULL',
            'update_by' => Schema::TYPE_STRING . '(45)',
            'create_time' => Schema::TYPE_INTEGER . ' NOT NULL',
            'update_time' => Schema::TYPE_INTEGER . '',
            'is_delete' => Schema::TYPE_BOOLEAN . '(1) NOT NULL default \'0\'',

        ]);
        $this->createTable('cms_media', [
            'cms_media_id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . '(100) NOT NULL',
            'content' => Schema::TYPE_STRING . '',
            'source_site' => Schema::TYPE_STRING . '(45)',
            'source_link' => Schema::TYPE_STRING . '(200)',
            'create_by' => Schema::TYPE_STRING . '(45) NOT NULL',
            'update_by' => Schema::TYPE_STRING . '(45)',
            'publisher_date' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'update_time' => Schema::TYPE_INTEGER . '(11)',
            'is_delete' => Schema::TYPE_BOOLEAN . '(1) NOT NULL default \'0\'',

        ]);
        $this->createTable('cms_notice', [
            'cms_notice_id' => Schema::TYPE_PK,
            'type' => Schema::TYPE_BOOLEAN . '(1) NOT NULL default \'0\'',
            'img' => Schema::TYPE_STRING . '(100)',
            'title' => Schema::TYPE_STRING . '(100) NOT NULL',
            'content' => Schema::TYPE_STRING . ' NOT NULL',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'update_time' => Schema::TYPE_INTEGER . '(11)',
            'publihser_date' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'create_by' => Schema::TYPE_STRING . '(45) NOT NULL',
            'update_by' => Schema::TYPE_STRING . '(45)',
            'is_delete' => Schema::TYPE_BOOLEAN . '(1) NOT NULL default \'0\'',

        ]);
        $this->createTable('cms_recruitment', [
            'cms_recruitment_id' => Schema::TYPE_PK,
            'type' => Schema::TYPE_BOOLEAN . '(1) NOT NULL',
            'title' => Schema::TYPE_STRING . '(45) NOT NULL',
            'content' => Schema::TYPE_STRING . '(45) NOT NULL',
            'create_by' => Schema::TYPE_STRING . '(45) NOT NULL',
            'update_by' => Schema::TYPE_STRING . '(45)',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'update_time' => Schema::TYPE_INTEGER . '(11)',
            'is_delete' => Schema::TYPE_BOOLEAN . '(1) NOT NULL default \'0\'',

        ]);

        $this->createTable('cms_law', [
            'cms_law_id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . '(150) NOT NULL',
            'type' => Schema::TYPE_BOOLEAN . '(1) NOT NULL',
            'content' => Schema::TYPE_STRING . ' NOT NULL',
            'create_by' => Schema::TYPE_STRING . '(45) NOT NULL',
            'update_by' => Schema::TYPE_STRING . '(45)',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'update_time' => Schema::TYPE_INTEGER . '(11)',
            'is_delete' => Schema::TYPE_BOOLEAN . '(1) NOT NULL default \'0\'',

        ]);
    }

    public function safeDown()
    {
    }
}
