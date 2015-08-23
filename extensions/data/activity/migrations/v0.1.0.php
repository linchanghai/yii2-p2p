<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace data\activity\migrations;

use kiwi\db\Migration;

class v0_1_0 extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('{{%activity}}',
            ['activity_type', 'activity_send_type', 'activity_send_value', 'valid_date', 'create_time', 'update_time', 'is_delete'],
            [
                [1, 1, 100, 30, time(), time(), 0],
                [1, 2, 0.1, 30, time(), time(), 0],
                [1, 3, 5, 30, time(), time(), 0],
                [1, 4, 2, 30, time(), time(), 0],
            ]
        );
    }

    public function safeDown()
    {

    }
}
