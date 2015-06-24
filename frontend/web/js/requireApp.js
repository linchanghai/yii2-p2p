requirejs.config({
    baseUrl: "/web/js/",
    paths: {
        "jquery" : "jquery.min",
        "bxslider": "jquery.bxslider.min"
    },
    shim:{
        "bxslider": ["jquery"]
    //    "zoom":["jquery"],
    //    "cartFly":["jquery"],
    //    "modal": ["jquery"],
    //    "placeholder":["jquery"],
    //    "libraries": ["jquery"],
    //    "mlselection": ["jquery"],
    //    "datePicker":["jquery"],
    //    "ajaxForm": ["jquery"]
    }
});
