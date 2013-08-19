jQuery(function(){
    jQuery(window).bind('scroll', function() {
        if (jQuery(window).scrollTop() > 50) {
            jQuery('.navbar-inner').addClass('fixed');
        }
        else {
            jQuery('.navbar-inner').removeClass('fixed');
        }
    });
});
