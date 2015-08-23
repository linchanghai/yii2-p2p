define(function(require,exports){
    var $ = require("jquery");

    //filter blank
    exports.filterBlank = function(obj){
        return obj.replace(/\s/g,"");
    };

    //filter number
    exports.filterNum = function(obj){
        return obj.replace(/^(-?d+)(.d+)?$/ig,"");
    };
    //cellphone
    exports.isMobile = function (obj) {
        var reg = /(13[0-9]|15[012356789]|17[0678]|18[0-9]|14[57])[0-9]{8}$/;
        return reg.test(obj);
    };

    //filter password
    exports.filterPwd = function(obj){
        var reg = /^(\w){6,14}$/;
        return reg.test(obj);
    };

    //if wechat browser
    exports.isWeiXinBrowser = function(){
        var ua = navigator.userAgent.toLowerCase();
        return (/micromessenger/.test(ua)) ? true : false ;
    };

    exports.filterFloatNum = function(obj){
        var reg = /^([1-9]\d*|0)(\.\d{1,2})?$/;
        return reg.test(obj);
    };

    //loading gif
    exports.showLoading = function(){
        var flexLoading = $("#flexLoading");
        if(flexLoading.length > 0){
            flexLoading.removeClass("hide");
        }else{
            $("body").append("<div class='flexLoading uiFlex flexMiddle flexCenter' id='flexLoading'><i></i></div>");
        }
    };

    exports.hideLoading = function(){
        $("#flexLoading").addClass("hide");
    };

    //modal info
    exports.showInfo = function(obj){
        var flexInfo = $("#flexInfo");
        function hideInfo(){
            var flexInfo = $("#flexInfo");
            flexInfo.children("i").fadeOut().end().fadeOut();
        }
        if(flexInfo.length > 0){
            flexInfo.children("i").html(obj).show().end().show();
        }else{
            $("body").append("<div class='flexInfo uiFlex flexMiddle flexCenter' id='flexInfo'><i>"+obj+"</i></div>");
        }
        setTimeout(hideInfo,2000);
    };

    $(function(){

        //collapse list detail
        $(".contentDetailWrap").on("tap",function(){
            var content = $(this).children("p");
            content.toggleClass("showDetail");
            if(content.hasClass("showDetail")){
                $(this).children(".detailCollapse").html("收起");
            }else{
                $(this).children(".detailCollapse").html("全文");
            }
        });
        // play audio
        $(".audioOperate").on("tap",function(){
            var audio = $(this).siblings("audio")[0];
            if(audio.paused){
                audio.play();
                $(this).html("&#xe611;");
            }else{
                audio.pause();
                $(this).html("&#xe603;");
            }

        });

        $(".listArrowBox").on("tap",function(){
            var contentModalOperate = $("#contentModalOperate"),contentModalDel = $("#contentModalDel");
            if($(this).hasClass("mySelf")){
                contentModalDel.length > 0?contentModalDel.removeClass("hide"):$("body").append("<div class='modalWrap' id='contentModalDel'><div class='whiteCover'></div><div class='coverMiddle'><ul class='whiteModalMenu'><li>删除微帖</li><li id='modalDelCancel'>取消</li></ul></div></div>");
                $("#modalDelCancel").on("tap",function(e){
                    $("#contentModalDel").addClass("hide");
                    e.stopPropagation();
                });
            }else{
                contentModalOperate.length > 0?contentModalOperate.removeClass("hide"):$("body").append("<div class='modalWrap' id='contentModalOperate'><div class='whiteCover'></div><div class='coverMiddle'><ul class='whiteModalMenu'><li><a class='defaultColor' href='#'>举报微帖</a></li><li id='modalOperateCancel'>取消</li></ul></div></div>");
                $("#modalOperateCancel").on("tap",function(e){
                    $("#contentModalOperate").addClass("hide");
                    e.stopPropagation();
                });
            }
        });


        //back to top
        var backToTop = document.getElementById("backToTop");
            if(backToTop){
                backToTop.addEventListener("touchstart",function(){
                document.body.scrollTop = 0;
            });
        }


        //footer menu
        $("#publishMoment").on("tap",function(){

        });



    })
});
