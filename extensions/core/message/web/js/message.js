/**
 * Created by LCH on 2014/11/22.
 */

$(function() {


    $(' .status_unread,.deleteMessage ').click(function() {
        $(this).removeClass('status_unread');
        $.post($(this).data('url'), {messageId:$(this).data('id')}, function(response) {
                if(response.redirect){
                    window.location.href= response.redirect;
                }
        }, 'json');
    });

});
