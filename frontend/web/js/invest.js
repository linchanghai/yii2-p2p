require(["jquery","common","modal"],function($,c){
    $(function(){
        //invest detail tab
        $(".investRuleTap li").on("click",function(){
            $(this).addClass("active").siblings("li").removeClass("active");
            $(".investSingleRule").eq($(this).index()).removeClass("hide").siblings(".investSingleRule").addClass("hide");
        });

        var leastMoney = Number($("#leastMoney").html()),
            mostMoney = Number($("#mostMoney").html()),
            investMoney = $(".investMoney"),
            myMoney = Number($("#myMoney").html()),
            lineMoney;
        mostMoney - myMoney >= 0 ?lineMoney = mostMoney:lineMoney = myMoney;
        $(".toInvest").on("click",function(){
            $('#investModal').modal();
        });
        $(".plus").on("click",function(){
            Number(investMoney.val())+leastMoney > lineMoney?true:investMoney.val(Number(investMoney.val())+leastMoney);
        });
        $(".minus").on("click",function(){
            Number(investMoney.val())-leastMoney < leastMoney?investMoney.val(leastMoney):investMoney.val(Number(investMoney.val()) - leastMoney);
        });
        investMoney.blur(function(){
            $(this).val(c.filterNum($(this).val()));
            Math.round($(this).val()%leastMoney) == 0?true:$(this).val(Math.round($(this).val()/leastMoney));
            $(this).val() < leastMoney?$(this).val(leastMoney):true;
            $(this).val() > lineMoney?$(this).val(lineMoney):true;
        });
    });
});