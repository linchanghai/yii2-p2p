require(["jquery","common","placeholder","datePicker"],function($,c){

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


        $('.datePicker').datetimepicker({
            format:'Y/m/d',
            minDate:'2015/07/07',
            maxDate:'+1970/01/2',
            timepicker:false
        });

    })

})