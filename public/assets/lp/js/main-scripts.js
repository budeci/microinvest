

$(document).ready(function() {


var elementPosition = $('.bar_head').offset();

$(window).scroll(function(){
        if($(window).scrollTop() > 0){
              $('.bar_head').css('position','fixed').css('top','0').css('display','block');
        } else {
            $('.bar_head').css('position','static').css('display','none');
        }    
});

var elementPosition = $('.bar_head').offset();

$(window).scroll(function(){
        if($(window).scrollTop() > 0){
              $('.bar_head').css('position','fixed').css('top','0').css('display','block');
        } else {
            $('.bar_head').css('position','static').css('display','none');
        }    
});

function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('glyphicon-plus glyphicon-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);
});