/**
 * Created by LCH on 2014/11/22.
 */

$(function() {

    //customer/update
    var InterValObj; //timer变量，控制时间
    var count = 60; //间隔函数，1秒执行
    var curCount;//当前剩余秒数
    $(' #email-bind ').click(function() {
        curCount = count;
        $(" #email-bind ").attr("disabled", "true");
        $(" #email-bind ").text("请等待" + curCount + "秒");
        InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
            $.post($(this).data('url'), '', function(response) {
                if (response.message) {
                    alert(response.message);
                }
                if (response.redirect) {
                    window.location.href = response.redirect;
                }
            }, 'json');
    });

//timer处理函数
    function SetRemainTime() {
        if (curCount == 0) {
            window.clearInterval(InterValObj);//停止计时器
            $(" #email-bind ").removeAttr("disabled");//启用按钮
            $(" #email-bind ").text("重新绑定");
        }
        else {
            curCount--;
            $("#email-bind").text("请等待" + curCount + "秒");
        }
    }

    $( ' #bind-phone ').click(function(){
        var formData = $('form').serialize();
        $.post($(this).data('url'), formData, function(response) {
            if (response.message) {
                alert(response.message);
            }
            if (response.redirect) {
                window.location.href = response.redirect;
            }
        }, 'json');
    })

    $(' #send-code ').click(function() {
        curCount = count;
        var formData = $('form').serialize();
        $(" #send-code ").attr("disabled", "true");
        $(" #send-code ").text("请等待" + curCount + "秒");
        InterValObj = window.setInterval(SetRemainTime2, 1000); //启动计时器，1秒执行一次
        $('#phoneCode').show();
        $.post($(this).data('url'), formData, function(response) {
            if (response.message) {
                alert(response.message);
            }
        }, 'json');
    });

//timer处理函数
    function SetRemainTime2() {
        if (curCount == 0) {
            window.clearInterval(InterValObj);//停止计时器
            $(" #send-code ").removeAttr("disabled");//启用按钮
            $(" #send-code ").text("重新发送");
        }
        else {
            curCount--;
            $("#send-code").text("请等待" + curCount + "秒");
        }
    }

    $("#customerinfo-age").keyup(function() {
        $("#customerinfo-age").val($('#customerinfo-age').val().replace(/\D|0/g,''));
    });

    $("#customeraddress-zip_code").keyup(function() {
        $("#customeraddress-zip_code").val($('#customeraddress-zip_code').val().replace(/\D/g,''));
    });

    $("#customeraddress-phone").keyup(function() {
        $("#customeraddress-phone").val($('#customeraddress-phone').val().replace(/\D/g,''));
    });

    // site/requestPasswordResetToken
    $("#article-type").change(function(){
        if($("#article-type").val()==2){
            $("#send-code-form").show();
        }else{
            $("#send-code-form").hide();
        }
    })

});
