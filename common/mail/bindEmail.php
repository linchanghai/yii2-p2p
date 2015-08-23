<?php
/**
 * @author Cangzhou.Wu(wucangzhou@gmail.com)
 * @Date 14-12-22
 * @Time 下午8:48
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['/member/member/bind-email', 'token' => $email->email_verify_token]);
?>

    Hello <?= Html::encode($user->username) ?>,

    Follow the link below to bind your email::

<?= Html::a(Html::encode($resetLink), $resetLink) ?>