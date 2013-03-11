
$(document).ready(function(){

    $('#sp2 a').click(function(){
        if($("#sp1").css('right') == '0px'){
            $('#sp1').animate({right:-365},1000);
        }else{
            $('#sp1').animate({right: 0},1000);
        }
    });

});