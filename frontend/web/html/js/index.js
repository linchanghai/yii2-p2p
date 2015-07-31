require.config({
    baseUrl: "/js",
    paths: {
        "jquery": "jquery.min",
        "common": "common"
    }
});

require(["jquery","common","bxslider"],function($){
    $(function(){
        //banner slider
        var banner = $("#banner");
        banner.bxSlider({
            mode:"fade",
            auto:true,
            pause:4000,
            infiniteLoop:true,
            tickerHover:true,
            autoHover:true,
            nextText:"",
            prevText:""
        });
        var controls = $(".bx-controls-direction");
        $(".banner").hover(function(){
            controls.show();
        },function(){
            controls.hide();
        });


    });
});