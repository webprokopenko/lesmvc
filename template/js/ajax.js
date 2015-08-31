var AddTovar = (function(){
    //Подключаем прослушку событий
    function setUpListeners(){
        $(document).ready(function(){
            $('.form').on('submit', _add_tovar);
        });
    }
    //Обработка сабмита формы #add_tovar
    function _add_tovar(ev){
        ev.preventDefault();
        var form = $(this),
            url = 'ajax/ajax_add_group.php',
            count_tov = $('#count_tov'),
            count_tov_n = Number(count_tov.text());

        count_tov.text(count_tov_n+1);
        count_tov.removeClass('hidden');
        //console.log(count_tov);
        //console.log(typeof(count_tov));
        //count_tov.text(count_tov.text()+1);

        //    defObject = _ajaxForm(form,url);
        //
        //defObject.done(function(ans){
        //    var ul = $('.list');
        //    for(var item in ans){
        //        var markup = '<li>'+ item +':' + ans[item] + '</li>';
        //        ul.append(markup);
        //    }
        //})
    }
    //Универсальная функция ajax
    function _ajaxForm(form,url){
        var data = form.serialize(),
            defObj = $.ajax({
                type: "POST",
                url: url,
                dataType: "JSON",
                data: data
            }).fail(function(){
                console.log('Проблемы на стороне сервера');
            })
        console.log(data);
        return defObj;
    };
    //Возвращаем в глобальную область видимости
    return{
        init: function(){
            setUpListeners();
        }
    }
}());

AddTovar.init();