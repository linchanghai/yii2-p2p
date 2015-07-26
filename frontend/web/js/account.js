require(["jquery","common","placeholder","modal","tooltip"],function($,c){
    $(function(){

        var accountdt = $("#accountSide dt");
        accountdt.on("click",function(e){
            var sd = $(this).siblings("dd");
            if(sd.is(":hidden")){
                sd.slideDown();
            }else{
                sd.slideUp();
            }
            sd.length > 0?e.preventDefault():true;
        });

        var singleWay = $(".singleWay");
        singleWay.on("click",function(){
            singleWay.children("img").removeClass("active");
            $(this).children("img").addClass("active");
            $(this).children("input").prop("checked",true);
        });

        var toggleItem = $("#toggleItem"),payHide = $("#payHide"),originText = toggleItem.html();
        toggleItem.on("click",function(){
            if(payHide.is(":hidden")){
                payHide.slideDown();
                $(this).html("收起");
            }else{
                payHide.slideUp();
                $(this).html(originText);
            }
        });

        var chargeMoney = $("#chargeMoney");
        chargeMoney.keyup(function(){
            $(this).val(c.filterNum($(this).val()));
        })
        chargeMoney.change(function(){
            checkMoney();
        });


        function checkMoney(){
            chargeMoney.val(c.filterNum(chargeMoney.val()));
            if(chargeMoney.val() >= 10){
                chargeMoney.siblings(".errorColor").addClass("hide");
                return true;
            }else{
                chargeMoney.siblings(".errorColor").removeClass("hide");
                return false;
            }
        }

        $("#rechargeBtn").on("click",function(){
            checkMoney();
            if(checkMoney()){
                $("#rechargeModal").modal();
                return false;
            }else{
                return false;
            }
        });

        $(".showTips").hover(function(){
            $(this).tooltip("toggle");
        });

        $(".switchWrap").on("click",function(){
            $(this).children(".switch").toggleClass("switchToggle");
        })

        $(".myWalletAreaTap li").on("click",function(){
            $(this).addClass("active").siblings("li").removeClass("active");
            $(".myWalletSingle").eq($(this).index()).removeClass("hide").siblings(".myWalletSingle").addClass("hide");
        });


        $("#walletSubmit").submit(function(){
            var myWalletNumber = $("#myWalletNumber"),myWalletOver = parseFloat($("#myWalletOver").html()).toFixed(2);
            if(parseFloat(myWalletOver - parseFloat(myWalletNumber.val()).toFixed(2)).toFixed(2) > 0 ){
                $(".errorColor").addClass("hide");
            }else{
                $(".errorColor").removeClass("hide");
                return false;
            }
        });

        var myWalletNumber = $("#myWalletNumber");

        $("#walletInForm").submit(function(){
            var myMoneyNow = parseFloat($("#myMoney").html()).toFixed(2);
            if(parseFloat(myMoneyNow - parseFloat(myWalletNumber.val()).toFixed(2)).toFixed(2) > 0 ){
                $(".errorColor").addClass("hide");
            }else{
                $(".errorColor").removeClass("hide");
                return false;
            }
        });

        myWalletNumber.keyup(function(){
            $(this).val(c.filterNum($(this).val()));
            $(this).val() > 0? true:$(this).val("");
            $("#willBe").html(parseFloat($(this).val()*.07).toFixed(2));
        })

        //my messages
        $(".messagesTable tr").on("click",function(){
            $(this).toggleClass("toggleContent");

        });

        $("#allMsg").on("change",function(){
            if($(this).prop("checked") == false){
                $(".msgCheck").prop("checked",false);
            }else{
                $(".msgCheck").prop("checked",true);
            }
        })

    });
});