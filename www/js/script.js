
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

$(document).ready(function(){
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