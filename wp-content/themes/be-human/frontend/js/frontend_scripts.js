jQuery(document).ready(function($) {
	
	// var top_slider = $('.widget_top_rated_products ul');
    // if (top_slider.length) {
        // top_slider.bxSlider({ minSlides: 1, maxSlides: 1 });
    // }
	
	$('.nav li, .nav li').on({
	 mouseenter: function() {
		$(this).children('ul').stop(true, true).slideDown(400);
	 },
	 mouseleave: function() {
		$(this).children('ul').slideUp(100);
	 }
	});
	

	$(".gallery a img").hover(
		function() {
			$(this).stop().animate({"opacity": "0.6"}, "slow");
		},
		function() {
		$(this).stop().animate({"opacity": "1"}, "slow");
		}
	);
	$(".navbar-inner ul >li").hover(
		function() {
			$(this).addClass('open');
		},
		function() {
			$(this).removeClass('open');
		}
	);
	
	
	$('.toggle-view li').click(function () {
        var text = $(this).children('div.panel');
        if (text.is(':hidden')) {
            text.slideDown('200');
            $(this).children('span').html('-');
        } else {
            text.slideUp('200');
            $(this).children('span').html('+');
        }
    });
	
	
	
	$('#devices a').click(function () {
        var rel_class = $(this).attr('rel');
		 $('#iframe').animate({
			width: $(this).attr('rel'),
			//height: 'toggle'
			}, 1500, function() {
			// Animation complete.
		});
		$('.container_iframe').animate({
			width: $(this).attr('rel'),
			//height: 'toggle'
			}, 1500, function() {
			// Animation complete.
		});
    });
	if($('#custom_menu_cp').length){
		$('div.nav > ul').unwrap();
		$('#custom_menu_cp').children('ul').addClass('nav');
	}
	
	
	if ( $('.blockx').length ){
		$(".blockx").equalHeights(); 
	}
	$('.footer_3_col .span4:nth-child(3n)').after('<hr />');
	$('.footer_4_col .span3:nth-child(4n)').after('<hr />');
	
	$(".bx-controls-direction .bx-prev").empty();
	$(".bx-controls-direction .bx-next").empty();
	$(".bx-controls-direction .bx-next").append('<span class="font_aw"><i class="icon-chevron-right"></i></span>');
	$(".bx-controls-direction .bx-prev").append('<span class="font_aw"><i class="icon-chevron-left"></i></span>');
	
	$(".banner_slider .bx-controls-direction .bx-prev").empty();
	$(".banner_slider .bx-controls-direction .bx-next").empty();
	$(".banner_slider .bx-controls-direction .bx-next").append('<span class="font_aw"><i class="icon-chevron-sign-right"></i></span>');
	$(".banner_slider .bx-controls-direction .bx-prev").append('<span class="font_aw"><i class="icon-chevron-sign-left"></i></span>');
	
	$(".containter_slider .bx-controls-direction .bx-prev").empty();
	$(".containter_slider .bx-controls-direction .bx-next").empty();
	$(".containter_slider .bx-controls-direction .bx-next").append('<span class="font_aw"><i class="icon-chevron-sign-right"></i></span>');
	$(".containter_slider .bx-controls-direction .bx-prev").append('<span class="font_aw"><i class="icon-chevron-sign-left"></i></span>');
	
	//var articleBodyWidth = $('.content').width(),
});