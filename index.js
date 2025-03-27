jQuery(document).ready(function($) {
    // Add class to body when scrolling to add white background
    var targetDiv = $('body');

    $(window).scroll(function() {
        var windowpos = $(window).scrollTop();

        // Change amount here to choose distance from top to add class
        if (windowpos >= 50) {
            targetDiv.addClass('scrolling-active');
        } else {
            targetDiv.removeClass('scrolling-active');
        }
    });
});

jQuery(document).ready(function($) {
    $('.wpr-mobile-toggle').click(function() {
        if($('.col-menu').hasClass('open')) {
            $('.col-menu').removeClass('open');
        } else {
            $('.col-menu').addClass('open');
        }
    });
});
