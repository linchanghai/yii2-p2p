<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('core_cms', 'Categories');

echo $this->render('@core/tree/views/tree/index');
