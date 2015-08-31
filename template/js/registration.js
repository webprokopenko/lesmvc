var FormSender = (function(){
    //Подключаем прослушку событий
    function setUpListeners(){
        $('#add_company').on('submit', _privateFunc_valid);
        $(document).ready(function(){
            $("#tel").inputmask("mask", {"mask": "(999) 999-99-99"});

        });
    }
    //Валидация
    //Создаем qtip
    function _createQtip (element, position) { // Создаем тултип
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
    }
    //Валидируем
    function  _privateFunc_valid(e) {
        e.preventDefault();
        var valid=true,
            empty=true,
            form = $(this),
            input_form = form.find('input, textarea').not('input[type="file"], input[type="hidden"]'),
            email =  form.find('input[type="email"]'),
            pass1 = form.find('#pass1'),
            pass2 = form.find('#pass2'),
            tel = form.find('tel');
            //input = form.find('input').not('input[type="file"], input[type="hidden"]');
            //message = $('textarea'),
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

        if(empty==true){
            console.log("empty true");
            if(!pattern_email.test(email.val())){
                $("registration__msg").text("Вы ввели некорректный Email").removeClass('sucess').addClass("error");
                valid=false;
                console.log("valid false email false");
            }else{
                if(pass1.val().length<6 || pass2.val().length<6){
                    $("#registration__msg").text("Пароль должен быть минимум 6 символов").removeClass('sucess').addClass("error");
                    valid=false;
                    console.log("valid false password min");
                }
               else if(pass1.val()!=pass2.val()) {
                   $("#registration__msg").text("Введенные пароли не совпадают").removeClass('sucess').addClass("error");
                    valid=false;
                    console.log("valid false email password not exemple");
               }
                else{
                   $("#registration__msg").text("").removeClass("error");

               }

            }
        }
        console.log("VALID"+valid);
        if(valid){
            _add_company();
        }
    }
    //Конец валидации
    //Добавление компании #add_company
    function _add_company(){
        var form = $('#add_company'),
            url = '/registration/add/',
            defObject = _ajaxForm(form,url),
            message_group = $('.registration__msg');
        defObject.done(function(ans){
            if(ans.error===0){
                message_group.text(ans.msg).removeClass('error').addClass("sucess");
                //_ajaxForm_redirect(ans.company,ans.pass);
            }
            else{
                message_group.text(ans.msg).removeClass('sucess').addClass("error");
            }
        })
    }
    //Функция ajax для редиректа при успешной регистрации
    function _ajaxForm_redirect(company,passw){
            defObj = $.ajax({
                type: "POST",
                url: 'ajax/ajax_avtorization.php',
                dataType: "JSON",
                data: {
                    login: company,
                    pass: passw,
                    redirect: true
                }
            }).fail(function(){
                console.log('Проблемы на стороне сервера');
            });
            defObj.done(function(){
                console.log(company);
                console.log(passw);
                window.location.href = "index.php";
            });
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
            });
        console.log(data);
        return defObj;
    }
    //Возвращаем в глобальную область видимости
    return{
        init: function(){
            setUpListeners();
        }
    }
}());

FormSender.init();