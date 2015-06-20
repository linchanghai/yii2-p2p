<?php

namespace core\cms\models;

use core\tree\models\Tree;
use kiwi\Kiwi;
use Yii;

/**
 * This is the model class for table "{{%category}}".
 */
class ArticleCategory extends Tree
{
    const TYPE_DEFAULT = 'articleCategory';
}
