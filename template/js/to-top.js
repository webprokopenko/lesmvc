(function($){

$(document).ready(function() {
    if ($('#to-top').length) {
        ToTop.init();
    }
});


var ToTop = (function(){

    var toTop = $('#to-top'),
        toTopHeight = toTop.outerHeight(),
        footer = $('.footer'),
        footerTop = footer.offset().top;

    function setUpListeners() {
        $(window).scroll(function() {
            var scrollTop = 0;

            // IE8 support
            if (document.documentElement && document.documentElement.scrollTop) {
                scrollTop = document.documentElement.scrollTop;
            }
            else {
                scrollTop = $(this).scrollTop();
            }

            if (scrollTop > 200) {
                toTop.fadeIn();
            }
            else {
                toTop.fadeOut();
            }

            // stop before footer
            if (toTop.offset().top + toTop.height() >= (footerTop - 10)) {
                toTop.addClass('to-top_position_absolute');
            }
            else if (scrollTop + this.innerHeight < footerTop) {
                toTop.removeClass('to-top_position_absolute');
            }

        });

        $('#to-top').click(function(e) {
            e.preventDefault();
            scrollToTop();
        });
    }

    // scroll body to top on click
    function scrollToTop() {
        $('body, html').animate({
            scrollTop: 0
        }, 500);
        return false;
    }

    return {
        init: function() {
            setUpListeners();
        }
    }

}());

}(jQuery));
