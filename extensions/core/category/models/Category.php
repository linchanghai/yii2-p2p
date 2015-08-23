<?php

namespace core\category\models;

use core\tree\models\Tree;
use kiwi\Kiwi;
use Yii;

/**
 * This is the model class for table "{{%category}}".
 */
class Category extends Tree
{
    const TYPE_DEFAULT = 'category';
}
