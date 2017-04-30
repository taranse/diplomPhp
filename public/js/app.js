$(document).ready(function () {
    $('ul.tabs').tabs();
    $('.collapsible').collapsible();
    $('body').css({
        'padding-bottom': $('footer').height()
    })
});