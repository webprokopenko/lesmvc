(function($){

$(document).ready(function() {
    if ($('.catalog-nav__trigger').length) {
        CatalogNav.init();
    }
});

var CatalogNav = (function() {
    var triggerClass = '.catalog-nav__trigger',
        triggerActiveClass = 'catalog-nav__trigger_active',
        subnavClass = '.catalog-nav__subnav'
        trigger = null,
        subnav = null,
        duration = 300;

    function setUpListeners() {
        $(triggerClass).on('click', function(e){
            e.preventDefault();
            trigger = $(this), // ссылка-триггер подменю
            subnav = trigger.siblings(subnavClass); // подменю, по родителю которого сделан клик

            if (trigger.hasClass(triggerActiveClass)) {
                subnavClose(trigger, subnav);
            }
            else {
                subnavOpen(trigger, subnav);
            }
        });
    }

    // открыть подменю
    function subnavOpen() {
        trigger.addClass(triggerActiveClass);
        subnav.stop(true, true).slideDown(duration);
        // закрыть все остальные подменю
        $(triggerClass).not(trigger)
            .removeClass(triggerActiveClass)
            .siblings(subnavClass).stop(true, true).slideUp(duration);
    }

    // закрыть подменю
    function subnavClose() {
        trigger.removeClass(triggerActiveClass);
        subnav.stop(true, true).slideUp(duration);
    }

    return {
        init: function() {
            setUpListeners();
        }
    }
}());

}(jQuery));
