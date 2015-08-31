var pupups = (function(){
    var setUpListners = function(){
            $('#avtorization').on('click', _openPopup);
            $('#avtorization_send').on('submit', _privateFunc_valid);
        },
    _removeError = function(){
        var element = $(this);
        element.removeClass('error');
    },
    _clearAll = function(){
        var form=$(this);
        form.find('input, textarea').trigger('hideTooltip').removeClass('error').val('');
    },
        //Функция валидации
    //Валидируем
        _privateFunc_valid = function  (e) {
        e.preventDefault();
        var valid=true,
            empty=true,
            form = $(this),
            input_form = form.find('input').not('input[type="file"], input[type="hidden"]'),
            email =  form.find('input[type="email"]'),
            pass =  form.find('input[type="password"]'),
            tel = form.find('tel');

        pattern_email =  /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;

        for(var i=0, max=input_form.length; i<max; i+=1){
            var element = $(input_form[i]),
                pos = element.attr('qtip-position');

            if(input_form[i].value.length === 0){
                empty = false;
                valid = false;
                _createQtip(element,pos);
            }
        }
        if(empty==true) {
            console.log("empty true");
            if (!pattern_email.test(email.val())) {
                $(".popup__msg").text("Вы ввели некорректный Email").removeClass('sucess').addClass("error");
                valid = false;
                console.log("valid false email false");
            } else {
                if (pass.val().length < 6) {
                    $(".popup__msg").text("Пароль должен быть минимум 6 символов").removeClass('sucess').addClass("error");
                    valid = false;
                    console.log("valid false password min");
                }
            }
        }
        if(valid==true){
            _avtorization();
        }

    },
    //Создаем qtip
        _createQtip = function  (element, position) { // Создаем тултип
        var contents = element.attr('qtip-content');
        // позиция тултипа
        if (position === 'right'){
            position = {
                my: 'left center',
                at: 'right center'
            }
        }else{
            position = {
                my: 'right center',
                at: 'left center',
            }
        }
        // инициализация тултипа
        element.qtip({
            content:{
                text: contents
            },
            show:{
                event: 'show'
            },
            hide:{
                event: 'keydown hideTooltip'
            },
            position: position,
            style:{
                classes: 'qtip-red',
                tip: {
                    height: 10,
                    width: 16
                }
            }
        }).trigger('show');
    },
        //Функция авторизации
     _avtorization = function(){
        var form = $("#avtorization_send"),
            url = '/authorization',
            defObject = _ajaxForm(form,url);
        defObject.done(function(ans){
            if(ans.error==0){
                $(".popup__msg").text(ans.msg).removeClass('error').addClass("sucess");
                window.location.href = window.location.href;
            }else{
                $(".popup__msg").text(ans.msg).removeClass('sucess').addClass("error");
            }
        })
    },
    //Универсальная функция ajax
    _ajaxForm =   function (form,url){
        var data = form.serialize(),
            defObj = $.ajax({
                type: "POST",
                url: url,
                dataType: "JSON",
                data: data
            }).fail(function(){
                console.log('Проблемы на стороне сервера');
            });
        console.log(data);
        return defObj;
    },
    _openPopup = function(e){
            e.preventDefault();
            $('#modal').bPopup({
                speed: 250,
                transition: 'slideDown',
                onClose: _clearAll
            });
    };
    return{
        init : function(){
            setUpListners();

        }
    }
}());

$(document).ready(function(){
    pupups.init();

});