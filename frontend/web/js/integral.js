require(["jquery","common","textslider"],function($,c){
    $(function(){

        $("#textSlider").textSlider({
            line:1,
            speed:500,
            timer:3000
        });
        //积分计算
        var leastLine = $("#leastLine"),
            leastIntegral = Number(leastLine.html()),
            exchangeIntegral = $(".investMoney"),
            myIntegral = Number($("#myIntegral").html());
        $(".toInvest").on("click",function(){
            $('#investModal').modal();
        });
        $(".plus").on("click",function(){
            if(leastIntegral*(Number(exchangeIntegral.val())+1) < myIntegral){
                exchangeIntegral.val(Number(exchangeIntegral.val())+1);
                leastLine.html(leastIntegral*exchangeIntegral.val());
            }

        });
        $(".minus").on("click",function(){
            if(Number(exchangeIntegral.val())>1){
                exchangeIntegral.val(Number(exchangeIntegral.val())-1);
                leastLine.html(Number(leastLine.html())-leastIntegral);
            }

        });
        exchangeIntegral.blur(function(){
            $(this).val(c.filterNum($(this).val()));
            if(Number($(this).val()) < 1){
                $(this).val(1);
                leastLine.html(leastIntegral);
            }else if(Number($(this).val())*leastIntegral > myIntegral){
                $(this).val(Math.round(myIntegral/leastIntegral));
                leastLine.html(Number($(this).val())*leastIntegral);
            }else{
                leastLine.html(Number($(this).val())*leastIntegral);
            }

        });

    });
});