define(function(require,exports){

    var $ = require("jquery");
    //filter number
    exports.filterNum = function(obj){
        return obj.replace(/[^0-9]/ig,"");
    };

    //filter blank
    exports.filterBlank = function(obj){
        return obj.replace(/\s/g,"");
    };

    //filter password
    exports.filterPwd = function(obj){
        var reg = /^(\w){6,14}$/;
        return reg.test(obj);
    };

    //filter email
    exports.isEmail = function (obj) {
        var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
        return reg.test(obj);
    };

    //cellphone
    exports.isMobile = function (obj) {
        var reg = /(13[0-9]|15[012356789]|17[0678]|18[0-9]|14[57])[0-9]{8}$/;
        return reg.test(obj);
    };

    $(".hoverItem li").hover(function(){
        $(this).addClass("activeHover").siblings("li").removeClass("activeHover");
        $(".hoverSingle").eq($(this).index()).removeClass("hide").siblings(".hoverSingle").addClass("hide");
    });

    $(".tabs li").on("click",function(e){
        console.log($(this).index())
        $(this).children("a").addClass("active").parent("li").siblings("li").children("a").removeClass("active");
        $(".tabContentWrap .tabContent").eq($(this).index()).removeClass("hide").siblings(".tabContent").addClass("hide");
        e.preventDefault();
    });

});