//dropdown menu open-close -JQUERY

$(document).ready(function(){

// =========load more pictures on scroll (-- Ajax Request-- )===========
 
/* var countBath = 8;
$(window).scroll(function(){
    var wrapBath = document.getElementById('wrapDiv-bath');
    var contentHeightBath = wrapBath.offsetHeight + 350;
    var yOffsetBath = window.pageYOffset;
    var yBath = yOffsetBath + window.innerHeight;
    if (yBath >= contentHeightBath){
        countBath = countBath + 8;
        $("#wrapDiv-bath").load("includes/insertImage.inc.php", {
            newCount:  countBath,
            newTable: "bath_img"
        });
    }

}); 


var countPill = 8;
$(window).scroll(function(){
    var wrap = document.getElementById('wrapDiv-pill');
    var contentHeight = wrap.offsetHeight + 350;
    var yOffset = window.pageYOffset;
    var y = yOffset + window.innerHeight;
    if (y >= contentHeight){
        countPill = countPill + 8;
        $("#wrapDiv-pill").load("includes/insertImage.inc.php", {
            newCount:  countPill,
            newTable: "pillows_img"
        });
    }

}); */

//===========================================================================

var timer;
function hideAll(){
    var dropdown = document.getElementsByClassName("dropdown-content");
    for(i=0; i<dropdown.length; i++){
        dropdown[i].style.display = "none";
    }
}
    
$("#bed").mouseenter(function(){
    clearTimeout(timer);
    timer = setTimeout(function () {
        hideAll();
        $("#cont-1").show();
    }, 500);
});


$("#pil").mouseenter(function(){
    clearTimeout(timer);
    timer = setTimeout(function () {
        hideAll();
        $("#cont-2").show();
    }, 500);
});


$("#bath").mouseenter(function(){
    clearTimeout(timer);
    timer = setTimeout(function () {
        hideAll();
        $("#cont-3").show();
    }, 500);
});

$("#bed, #pil, #bath, .dropdown-content").mouseleave(function(){
    clearTimeout(timer);
    timer = setTimeout(function () {
        hideAll();
    }, 500);
});

$(".dropdown-content").mouseenter(function(){
    clearTimeout(timer);
});

});


// slideshow automatski
var index = 0;
var slide = document.getElementsByClassName("slider-main");
function mySlide(){
    t = setInterval( function(){
        if (index > slide.length-1){
            index = 0;
        }
        for (i=0; i<slide.length; i++){
            slide[i].style.display = "none";
        }
            slide[index].style.display = "block";
            index++;
            
    }, 4000);
}
mySlide();
    
//footer ***radi!***

var TfooterShow;

$("footer").mouseenter(function(){
    TfooterShow = setTimeout(function () {
        $("#hidden-footer").slideDown();
    }, 800);
});
$("footer").mouseleave(function(){
        clearTimeout(TfooterShow);
        $("#hidden-footer").slideUp();
});






