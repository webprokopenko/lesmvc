// Переключение вида каталога (линиями / сеткой)
(function($){

$(document).ready(function() {
    CatalogStyle.init();
});

var CatalogStyle = (function() {

    // допустимые значения
    var stylesAllowed = ['rows', 'grid'];

    function setUpListeners() {
        $('.catalog-style__select').on('change', function() {
            // выбранная опция
            var style = $(this).find(':selected').val();
            if ($.inArray(style, stylesAllowed) !== -1) {
                changeStyle(style);
            }
        })
    }

    // Изменение значения модификатора каталога, отвечающего за его вид
    function changeStyle(style) {
        var catalog = $('.catalog'),
            catalogClass = 'catalog_style_';

        // удалить модификатор
        $.each(stylesAllowed, function(index, value){
            catalog.removeClass(catalogClass + value);
        });

        // сформировать модификатор
        catalogClass += style;

        // добавить модификатор
        catalog.addClass(catalogClass);
    }

    return {
        init: function() {
            setUpListeners();
        }
    }
}());

}(jQuery));
