<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

?>
<div class="containerMain backGrey">
<div class="itemTitle">
基本信息
</div>
    <div class="clearFix myInfo">
        <table class="table ">
            <tbody>
            <tr>
                <td class="textRight">用户名</td>
                <td><?= Yii::$app->user->identity->username ?></td>

            </tr>
            <tr>
                <td class="textRight">邮箱</td>
                <td><?= $member->email ?></td>
                <td><?php
                    Pjax::begin();
                    ActiveForm::begin([
                        'method' => 'post',
                        'action' => Url::to(['/member/member/send-email']),
                        'options' => ['data-pjax' => 1]
                    ]);
                    echo Html::submitButton($memberStatus->email_status ? '<span class="glyphicon glyphicon-ok themeColor"></span>'.'解除绑定' : '绑定',
                        ['class' =>'themeColor backGrey',
                            'id' => 'email-bind',
                            'data-url' => Url::to(['/member/member/send-email'])]);
                    ActiveForm::end();
                    Pjax::end();
                    ?>
                </td>
            </tr>
            <tr>
                <td class="textRight">手机</td>
                <td><?= $member->mobile ?></td>
                <td><?= $memberStatus->mobile_status ?'<span class="glyphicon glyphicon-ok themeColor"></span>'. Html::a('解除绑定', ['/member/member/bind-phone'], ['class' => 'themeColor']) : Html::a('绑定', ['/member/member/bind-phone'], ['class' => 'themeColor']) ?></td>
            </tr>
            <tr>
                <td class="textRight">真实姓名</td>
                <td><?= isset($member->real_name) && isset($member->id_card) ? $member->real_name :'未设置'?></td>
                <td><?= isset($member->real_name) && isset($member->id_card) ? '<span class="glyphicon glyphicon-ok themeColor"></span>' :Html::a('实名认证', ['/member/member/save-real-name'],['class'=>'themeColor'])?></td>
            </tr>
            <tr>
                <td class="textRight">身份证</td>
                <td><?= isset($member->real_name) && isset($member->id_card) ? $member->id_card :'未设置'?></td>
                <td><?= isset($member->real_name) && isset($member->id_card) ? '<span class="glyphicon glyphicon-ok themeColor"></span>' :''?></</td>
            </tr>
            </tbody>
        </table>
        <div class="mt20 p20 textCenter">
            <span class="glyphicon glyphicon-info-sign themeColor"></span>
            因个人信息涉及到发生购买行为的合同有效性,故个人信息不可修改
        </div>
    </div>
</div>

