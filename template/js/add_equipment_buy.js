var pupups_equipment_buy = (function(){
    var setUpListners = function(){
            $('#add_equipment_buy').on('click', _openPopup);
            $('#market_equipment_send').on('submit', _privateFunc_valid);
            $(document).ready(function(){
                var url = '/equipmentbuy/add/';
                $('#foto_equipment').fileupload({
                    url: url,
                    dataType: 'json',
                    done: function (e,ans) {
                        if(ans.jqXHR.responseJSON.error==0){
                            document.getElementById("filename").value = ans.jqXHR.responseJSON.file_name;
                            $("#download_img").html("<div class='download_img-wrapp'><img src='../uploads/"+ans.jqXHR.responseJSON.file_name+"'></div>");
                        }
                        else{
                            $(".popup__msg-buy").text(ans.jqXHR.responseJSON.msg).removeClass('sucess').addClass("error");

                        }
                    }
                });
            });
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
                input_form = form.find('input').not('input[type="file"], input[type="hidden"]');

            for(var i=0, max=input_form.length; i<max; i+=1){
                var element = $(input_form[i]),
                    pos = element.attr('qtip-position');

                if(input_form[i].value.length === 0){
                    empty = false;
                    valid = false;
                    _createQtip(element,pos);
                }
            }
            if(valid==true){
                _market_equipment_add();
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
    //Функция добавления объявления о продаже
        _market_equipment_add = function(){
            var form = $("#market_equipment_send"),
                url = '/equipmentbuy/add/',
                defObject = _ajaxForm(form,url);
            defObject.done(function(ans){
                if(ans.error===0){
                    $(".popup__msg-buy").text(ans.msg).removeClass('error').addClass("sucess");
                    window.location.href = "/equipmentbuy/";
                }
                else{
                    $(".popup__msg-buy").text(ans.msg).removeClass('sucess').addClass("error");
                }
            })
        },
    //Универсальная функция ajax
        _ajaxForm =   function (form,url){
            var data = form.serialize();
            defObj = $.ajax({
                type: "POST",
                url: url,
                data: data
            }).fail(function(ans){
                console.log('Проблемы на стороне сервера');
                $(".popup__msg-buy").text(ans.msg).removeClass('sucess').addClass("error");
            });
            return defObj;
        },
        _openPopup = function(e){
            e.preventDefault();
            $('#modal_equipment_buy').bPopup({
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
    pupups_equipment_buy.init();

});