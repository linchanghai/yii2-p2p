requirejs.config({
    baseUrl: "/web/js/",
    paths: {
        "jquery" : "jquery.min",
        "bxslider": "jquery.bxslider.min",
        "textslider": "jquery.textslider"
    },
    shim:{
        "bxslider": ["jquery"],
        "textslider":["jquery"]
    //    "cartFly":["jquery"],
    //    "modal": ["jquery"],
    //    "placeholder":["jquery"],
    //    "libraries": ["jquery"],
    //    "mlselection": ["jquery"],
    //    "datePicker":["jquery"],
    //    "ajaxForm": ["jquery"]
    }
});
