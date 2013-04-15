$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
        $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

function tootgleSlider(){
    if($("#sp1").css('right') == '0px'){
        $('#sp1').animate({right:-367},1000);
    }else{
        $('#sp1').animate({right: 0},1000);
    }
}
function submit(form){
    $('#'+form).submit();
}
function submitSearchForm(form){
    if($('#'+form).find('#query').val() == 'Samsung LCD 43 HD'){
        $('#'+form).find('#query').val('');
    }
    if($('#'+form).find('#localization').val() == 'Bez lokalizacji'){
        $('#'+form).find('#localization').val('');
    }
    if($('#'+form).find('#km_distance_input').val() == 'Zasięg w km'){
        $('#'+form).find('#km_distance_input').val('');
    }
    if($.isNumeric($('#km_distance').val())){
        $('input[type=radio]').each(function(){
            $(this).attr('disabled', true);
        });
        if($('#'+form).find('#query').val() == ''){
            alert('Podaj Szukany Produkt.');
        }else{
            $('#'+form).submit();
        }

    }else{
        alert('Wprowadź zasięg. Bląd: Niepoprawna wartość pola.');
    }
}

//left shop lists
function displayShopsList(){
    //niewiem jak narazie ma działac wyszukiwanie itp wiec robie all partners1
    if($('#curiosel').length>0){
    var success = function(data, textStatus, jqXHR){
        $('#curiosel').html(data);
    }
    data = '';
    ajaxRequest('displayShopsList',data,success);
    }
}


//popup functions
function displayProduct(id_product){
    var success = function(data, textStatus, jqXHR){
        $('#popupwindow').html(data);
        displayPopupWindow();
    }
    data = {"id_product" : id_product};
    ajaxRequest('displayProduct',data,success);
}

function displayShop(id_shop){
    var success = function(data, textStatus, jqXHR){
        $('#popupwindow').html(data);
        displayPopupWindow();
    }
    data = {"id_shop" : id_shop};
    ajaxRequest('displayShop',data,success);
}
function displayNoResults(){
    var success = function(data, textStatus, jqXHR){
        $('#popupwindow').html(data);
        displayPopupWindow();
    }
    data = '';
    ajaxRequest('displayNoResults',data,success);
}

function formDisplayMeeting(id_shop){
    var success = function(data, textStatus, jqXHR){
        $('#popupwindow2').html(data);
        displayFormWindow();
    }
    data = {"id_shop" : id_shop};
    ajaxRequest('formDisplayMeeting',data,success);
}
function formDisplayComment(id_shop){
    var success = function(data, textStatus, jqXHR){
        $('#popupwindow2').html(data);
        displayFormWindow();
    }
    data = {"id_shop" : id_shop};
    ajaxRequest('formDisplayComment',data,success);
}
function formDisplayQuestion(id_shop){
    var success = function(data, textStatus, jqXHR){
        $('#popupwindow2').html(data);
        displayFormWindow();
    }
    data = {"id_shop" : id_shop};
    ajaxRequest('formDisplayQuestion',data,success);
}

//Popup windows
function displayPopupWindow(){
    screenHeight  = $( document ).height();
    $('#popupwindow').css('height',screenHeight);
    $('#popupwindow').css('display','block');
}
function closePopupWindow(){
    $('#popupwindow').css('display','none');
    $('#popupwindow').html('');
}
function displayFormWindow(){
    screenHeight  = $( document ).height();
    $('#popupwindow2').css('height',screenHeight);
    $('#popupwindow2').css('display','block');
}
function closeFormWindow(){
    $('#popupwindow2').css('display','none');
    $('#popupwindow2').html('');
}

function send_meeting_email(){
    var success = function(data, textStatus, jqXHR){
        if(data.success){
            $('#forminfo').html(data.message);
            $('#forminfo').css('display','block');
            clearFormElements('#meetingshop');
            $('#meetingshop input[name=time]').val('10:00');
        }else{
            alert('Wystąpił błąd.Przepraszamy');
            closeFormWindow();
            closePopupWindow();
        }
    }
    data = $("#meetingshop").serializeObject();//JSON.stringify()
    ajaxRequestJson('sendMeetingEmail',data,success);
}
function send_question_email(){
    var success = function(data, textStatus, jqXHR){
        if(data.success){
            $('#forminfo').html(data.message);
            $('#forminfo').css('display','block');
            //clear form
            clearFormElements('#questionshop');
        }else{
            alert('Wystąpił błąd.Przepraszamy');
            closeFormWindow();
            closePopupWindow();
        }
    }
    data = $("#questionshop").serializeObject();//JSON.stringify()
    ajaxRequestJson('sendQuestionEmail',data,success);
}
function send_comment_email(){
    var success = function(data, textStatus, jqXHR){
        if(data.success){
            $('#forminfo').html(data.message);
            $('#forminfo').css('display','block');
            clearFormElements('#commentshop');
        }else{
            alert('Wystąpił błąd.Przepraszamy');
            closeFormWindow();
            closePopupWindow();
        }
    }
    data = $("#commentshop").serializeObject();//JSON.stringify()
    ajaxRequestJson('CommentShop',data,success);
}

function ajaxRequest(method,data,success){
    url = 'http://www.knsdes.nazwa.pl/www_gdzieobejrze_pl/www/index.php/jsroute';
    $.ajax({
        //dataType: "json",
        dataType: "html",
        url: url,
        type: "POST",
        data: "method="+method+"&data="+JSON.stringify(data),
        success: function(data, textStatus, jqXHR){
            if(textStatus == 'success'){
                if(data == ''){closePopupWindow()}else{success(data, textStatus, jqXHR);}
            }else{
                closePopupWindow();
                alert('Wystąpił nieoczekiwany błąd.')
            }
        },
        failure: function(){
            alert('Wystąpił problem z połączeniem...');
        }
    });
}
function ajaxRequestJson(method,data,success){
    url = 'http://www.knsdes.nazwa.pl/www_gdzieobejrze_pl/www/index.php/jsroute';
    $.ajax({
        dataType: "json",
        //dataType: "html",
        url: url,
        type: "POST",
        data: "method="+method+"&data="+JSON.stringify(data),
        success: function(data, textStatus, jqXHR){
            if(data == ''){closePopupWindow()}else{success(data, textStatus, jqXHR);}
        },
        failure: function(){
            alert('Wystąpił problem z połączeniem...');
        }
    });
}

function searchFrom(){
    //distance form
    $('input[type=radio]').click(function(){
        $('input#km_distance').val($(this).val());
        $('input#km_distance_input').val('Zasięg w km');
    });
    $('input#km_distance_input').click(function(){
        $('input[type=radio]').each(function(){
            $(this).prop('checked', false);
        });
    });
    $('input#km_distance_input').blur(function(){
        if($(this).val() != '' && $(this).val() != 'Zasięg w km'){
            if($.isNumeric($(this).val())){
                $('input#km_distance').val($(this).val());
            }else{
                alert('Wprowadź zasięg Bląd: Niepoprawna wartość pola.');
            }
        }
        if($(this).val() == '' || $(this).val() == 'Zasięg w km'){
            $('#radio-1-1').prop('checked', true);
            $('input#km_distance').val(1);
        }
    });
}

function left_slider(){
    //add click event
    $("#next").click(function(e) {
        e.preventDefault();
        $(this).each(function(){
            MyCarousel('next');
        });
    });
    $("#prev").click(function(e) {
        e.preventDefault();
        $(this).each(function(){
            MyCarousel('prev');
        });
    });
}
function MyCarousel(opt){
    var blockMaxHeight = 0 - $('#curiosel').height();
    var elements = 2;
    var slideValue = 143; // px
    var currentTop = parseInt($('#curiosel').css('top'));
    blockMaxHeight = blockMaxHeight + (slideValue*elements);
//    currentTop = target}
//    alert(currentTop+' '+slideValue);
//    alert((currentTop % slideValue)==0);

    if((currentTop % slideValue)==0) {
    if(opt == 'next'){
        var target = currentTop - parseInt(slideValue);
        if(target > blockMaxHeight){
            $('#curiosel').animate({
                top: target+'px'
            });
        }
    }
    if(opt == 'prev'){
        var target = parseInt(currentTop) + parseInt(slideValue);
        if(target < 0){
            $('#curiosel').animate({
                top: target+'px'
            });
        }
    }
    }
}
function clearFormElements(ele) {

    $(ele).find(':input').each(function() {
        switch(this.type) {
            case 'password':
            case 'select-multiple':
            case 'select-one':
            case 'text':
            case 'textarea':
                $(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
        }
    });

}

$(document).ready(function(){
    searchFrom();
    //ładuje liste sklepów po lewej
    displayShopsList();
    left_slider();
    //funcja do wyswietlania braku rezultatów
    //displayNoResults();
});

//slider right
//    $('#sp2 a').click(function(){
//        alert($("#sp1").css('right'));
//        if($("#sp1").css('right') == '0px'){
//            $('#sp1').animate({right:-367},1000);
//        }else{
//            $('#sp1').animate({right: 0},1000);
//        }
//    });
