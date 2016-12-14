// JavaScript Document
$(window).scroll(function () {
    var scrollh = $(this).scrollTop();
    if (scrollh == 0) {
        $(".navbar").css({
			'padding-top':'20px',
			'padding-bottom':'20px', 

        });
    } else {
        $(".navbar").css({
			'padding':'0px',			
        });
    }
});