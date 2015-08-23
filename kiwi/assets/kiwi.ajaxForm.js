/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn).
 */
(function ($) {
    var validate = function () {
        var form = this.form;
        if (form.data('yiiActiveForm').validated) {
            form.find('[type=submit]').attr('disabled', 'disabled');
            form.addClass('ajaxSubmitForm');
            return true;
        }
        return false;
    };

    var respond = function (data, status, response) {
        var form = $('.ajaxSubmitForm');
        form.removeClass('ajaxSubmitForm');
        form.data('yiiActiveForm').validated = false;
        form.data('yiiActiveForm').submitting = false;
        form.find('[type=submit]').removeAttr('disabled');

        if (data.alert) {
            var alert = data.alert;
            var alertTypes = ['success', 'warning', 'info', 'error', 'danger'];
            for (var i in alertTypes) {
                var alertType = alertTypes[i];
                if (alert[alertType]) {
                    $(window).triggerHandler('alert.' + alertType, [[alert[alertType]]]);
                    if (alertType == 'success') {
                        $(window).triggerHandler('redirect.refresh', [[window.location.href]]);
                    }
                }
            }
        } else {
            $(window).triggerHandler('redirect.refresh', [[window.location.href]]);
        }

        if (data.redirect && data.redirect != window.location.href) {
            $(window).triggerHandler('redirect.to', [[data.redirect]]);
        }
    };

    var defaults = {
        beforeSubmit: validate,
        success: respond,
        dataType: 'json',
        timeout: 3000
    };

    $.fn.kiwiAjaxForm = function (options) {
        options = $.extend(defaults, options, {form: this});
        this.ajaxForm(options);
    };

})(window.jQuery);
