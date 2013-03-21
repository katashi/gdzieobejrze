
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
        $('#'+form).submit();
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

function ajaxRequest(method,data,success){
    url = 'http://www.knsdes.nazwa.pl/www_gdzieobejrze_pl/www/index.php/main/run/jsroute';
    $.ajax({
        //dataType: "json",
        dataType: "html",
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

$(document).ready(function(){
    searchFrom();
    //ładuje liste sklepów po lewej
    displayShopsList();
    left_slider();
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
