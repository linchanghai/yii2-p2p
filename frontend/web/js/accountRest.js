require(["jquery","common","placeholder","datePicker"],function($,c){

    $(function(){


        $('.datePicker').datetimepicker({
            format:'Y/m/d',
            minDate:'2015/07/07',
            maxDate:'+1970/01/2',
            timepicker:false
        });

    })

})