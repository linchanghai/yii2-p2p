<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model core\cms\models\CmsRecruitment */

$this->title = Yii::t('core_cms', 'Create Cms Recruitment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('core_cms', 'Cms Recruitments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-recruitment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
