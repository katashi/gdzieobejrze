
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
    //alert($(form).find('input'));
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
        $('#'+form).submit();
    }else{
        alert('Wprowadź zasięg. Bląd: Niepoprawna wartość pola.');
    }

}

//popup functions
function displayProduct(){
    var success = function(data, textStatus, jqXHR){
        $('#popupwindow').html(data);
        displayPopupWindow();
    }
    data = '';
    ajaxRequest('displayProduct',data,success);
}

//Popup windows
function displayPopupWindow(){
    $('#popupwindow').css('display','block');
}
function closePopupWindow(){
    $('#popupwindow').css('display','none');
    $('#popupwindow').html('');
}

function ajaxRequest(method,data,success){
    url = 'http://www.knsdes.nazwa.pl/www_gdzieobejrze_pl/www/index.php/main/run/jsroute';
    $.ajax({
        //dataType: "json",
        dataType: "html",
        url: url,
        type: "POST",
        data: "method="+method+"&data="+JSON.stringify(data),
        success: function(data, textStatus, jqXHR){success(data, textStatus, jqXHR);},
        failure: function(){
            alert('Wystąpił problem z połączeniem...');
        }
    })
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
        }
    });
}

$(document).ready(function(){
    searchFrom();



//slider right
//    $('#sp2 a').click(function(){
//        alert($("#sp1").css('right'));
//        if($("#sp1").css('right') == '0px'){
//            $('#sp1').animate({right:-367},1000);
//        }else{
//            $('#sp1').animate({right: 0},1000);
//        }
//    });

});