
(function ($) {
	"use strict";

	$('.block2-btn-addwishlist').each(function(){
		var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
		$(this).on('click', function(){
			swal(nameProduct, "is added to wishlist !", "success");
		});
	});

	// Testimonial Slider
	$('.testimonial-slider').slick({
		dots: true,
		arrows: false,
		autoplay: true
	});

	// Menu
	var mobileMenu = $('#primary_menu').html();
	$('header.header').append('<div class="wrap-side-menu"><nav class="side-menu">'+ mobileMenu +'</div></div>');
	
	$('.side-menu > ul').removeClass('main_menu').addClass('main-menu');
	$('.side-menu ul.sub_menu').removeClass('sub_menu').addClass('sub-menu').before('<i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>');

	// Search In Mobile Menu
	var searchMenu = $('.topbar-child1').html();
	$('.side-menu > ul').append('<li></li>');

	// Class add to menu
	$('.side-menu > ul > li').addClass('item-menu-mobile');

	$('#primary_menu ul.main_menu ul.sub_menu').before('<i class="arrow-main-menu fa fa-angle-down" aria-hidden="true"></i>');


	// Mobile Logo
	var logoElement = $('.logo').clone().removeClass('logo').addClass('logo-mobile');
	$('.wrap_header_mobile').prepend(logoElement);

	// 
	var headerIcons = $('.topbar .header-icons').clone().removeClass('header-icons').addClass('header-icons-mobile');
	// $('.wrap_header_mobile .btn-show-menu').prepend(headerIcons);

})(jQuery);