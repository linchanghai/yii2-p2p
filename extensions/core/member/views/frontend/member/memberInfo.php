<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use \yii\widgets\ActiveForm;
?>

<?= Html::textInput('phone',$member->mobile)?>
<?= $memberStatus->mobile_status? Html::a('解除绑定',['/member/member/bind-phone']):Html::a('绑定',['/member/member/bind-phone'])?>


<?= Html::textInput('eamil',$member->email)?>
<?php
    Pjax::begin();
    ActiveForm::begin([
    'method' => 'post',
    'action' => Url::to(['/member/member/send-email']),
    'options' => ['data-pjax' => 1]
    ]);
    echo  Html::submitButton($memberStatus->email_status ?  '解除绑定邮箱' :  '绑定邮箱',
        ['class' => $memberStatus->email_status ? 'btn btn-success' : 'btn btn-primary',
            'id' => 'email-bind',
            'data-url'=>  Url::to(['/member/member/send-email'])]);
    ActiveForm::end();
    Pjax::end();

    if(isset($member->real_name)&&isset($member->id_card)){
        echo $member->real_name;
        echo $member->id_card;
    }else{
        echo Html::a('实名认证',['/member/member/save-real-name']);
    }


?>
