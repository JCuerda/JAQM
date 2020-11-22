$(function () {

    $(window).on('load', function () {
        let screen = $('div#normal-loading');
        screen.css('display', 'none');
    });

    $(document).bind('ajaxStart', function () {
        let screen = $('div#loading-screen');
        screen.removeAttr("hidden");
    }).bind('ajaxStop', function () {
        let screen = $('div#loading-screen');
        screen.attr("hidden","hidden");
    });

});