$(function () {
    $(' .exchange-coupon ').click(function () {
        $.post($(this).data('url'), {id: $(this).data('id')}, function (response) {
            if (response.message) {
                alert(response.message);
            }
            if (response.redirect) {
                window.location.href = response.redirect;
            }
        }, 'json');
    });
});