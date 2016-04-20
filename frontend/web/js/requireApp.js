requirejs.config({
    baseUrl: "/web/js/",
    paths: {
        "jquery" : "jquery.min",
        "bxslider": "jquery.bxslider.min",
        "textslider": "jquery.textslider",
        "modal": "modal",
        "placeholder": "placeholder",
        "datePicker": "jquery.datetimepicker",
        "tooltip":"tooltip"
    },
    shim:{
        "bxslider": ["jquery"],
        "textslider":["jquery"],
        "placeholder":["jquery"],
        "tooltip": ["jquery"],
        "datePicker": ["jquery"],
        "modal": ["jquery"]
    }
});
