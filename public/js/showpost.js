/*Scroll to top when arrow up clicked BEGIN*/
$(window).scroll(function() {
    var height = $(window).scrollTop();
    if (height > 100) {
        $('#back2Top').fadeIn();
    } else {
        $('#back2Top').fadeOut();
    }
});
$(document).ready(function() {
    $("#back2Top").click(function(event) {
        event.preventDefault();
        $("html, body").animate({
            scrollTop: 0
        }, "slow");
        return false;
    });

});

$(function() {
    setTimeout(function() {
        $('.fade-message').fadein();
    }, 2000);
});
$(function() {
    setTimeout(function() {
        $('.fade-mail-message').fadein();
    }, 2000);
});