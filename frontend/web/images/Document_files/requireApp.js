requirejs.config({
    baseUrl: "/js",
    paths: {
        "jquery" : "jquery",
        "swiper": "swiper",
        "library": "library"
    },
    shim:{
        "library": ["jquery"]
    }
});
