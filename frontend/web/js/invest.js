require(["jquery", "common", "modal"], function ($, c) {
    $(function () {
        //invest detail tab
        $(".investRuleTap li").on("click", function () {
            $(this).addClass("active").siblings("li").removeClass("active");
            $(".investSingleRule").eq($(this).index()).removeClass("hide").siblings(".investSingleRule").addClass("hide");
        });

        var leastMoney = Number($("#leastMoney").html()),
            mostMoney = Number($("#mostMoney").html()),
            myMoney = Number($("#myMoney").html()),
            lineMoney;
        mostMoney - myMoney >= 0 ? lineMoney = mostMoney : lineMoney = myMoney;
        $(".toInvest").on("click", function () {
            investTable();
            $('#investModal').modal();
        });
        $('#investModal').on("click", '.plus', function () {
            investMoney = $(".investMoney"),
            Number(investMoney.val()) + leastMoney > lineMoney ? true : investMoney.val(Number(investMoney.val()) + leastMoney);
            investTable();
        }).on("click", '.minus', function () {
            investMoney = $(".investMoney"),
            Number(investMoney.val()) - leastMoney < leastMoney ? investMoney.val(leastMoney) : investMoney.val(Number(investMoney.val()) - leastMoney);
            investTable();
        }).on('blur', '.investMoney', function () {
            $(this).val(c.filterNum($(this).val()));
            Math.round($(this).val() % leastMoney) == 0 ? true : $(this).val(Math.round($(this).val() / leastMoney));
            $(this).val() < leastMoney ? $(this).val(leastMoney) : true;
            $(this).val() > lineMoney ? $(this).val(lineMoney) : true;
        });

        function investTable() {
            var url = $(".toInvestArea").data("url") + "&invest_money=" + $(".investMoney").val();
            $(".investSingleMoney").load(url);
        }
    });
});