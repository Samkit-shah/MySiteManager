/*Scroll to top when arrow up clicked BEGIN*/
$(window).scroll(function () {
    var height = $(window).scrollTop();
    if (height > 100) {
        $('#backtoTop').fadeIn();
    } else {
        $('#backtoTop').fadeOut();
    }
});
$(document).ready(function () {
    $("#backtoTop").click(function (event) {
        event.preventDefault();
        $("html, body").animate({
            scrollTop: 0
        }, "slow");
        return false;
    });

});

$(function () {
    setTimeout(function () {
        $('.fade-message').slideUp();
    }, 600);
});
$(function () {
    setTimeout(function () {
        $('.fade-mail-message').slideUp();
    }, 600);
});
