(function($) {
    "use strict";
    $(window).on('load', function() {
       
        $('.btn-cart').tooltip({
            title: "Add to Cart",
        });
        $('.btn-wish').tooltip({
            title: "Wishlist",
        });
        $('.btn-quickview').tooltip({
            title: "Quick View",
        });
       
        $('.mobile-menu').slicknav({
            prependTo: '.navbar-header',
            parentTag: 'liner',
            allowParentLinks: true,
            duplicate: true,
            label: '',
            closedSymbol: '<i class="fa fa-angle-right"></i>',
            openedSymbol: '<i class="fa fa-angle-down"></i>',
        });
        
    });
    $(".nav > li:has(ul)").addClass("drop");
    $(".nav > li.drop > ul").addClass("dropdown");
    $(".nav > li.drop > ul.dropdown ul").addClass("sup-dropdown");
    $(window).on('load', function() {
        "use strict";
        $('#loader').fadeOut();
    });
    $("#new-products").owlCarousel({
        navigation: true,
        pagination: false,
        slideSpeed: 1000,
        stopOnHover: true,
        autoPlay: true,
        items: 4,
        itemsDesktopSmall: [1024, 2],
        itemsTablet: [600, 1],
        itemsMobile: [479, 1]
    });
    $('#new-products').find('.owl-prev').html('<i class="fa fa-angle-left"></i>');
    $('#new-products').find('.owl-next').html('<i class="fa fa-angle-right"></i>');
    $("#new-slider").owlCarousel({
        navigation: false,
        pagination: false,
        slideSpeed: 1000,
        stopOnHover: true,
        autoPlay: 3000,
        items: 1,
        itemsDesktopSmall: [1024, 2],
        itemsTablet: [600, 1],
        itemsMobile: [479, 1]
    });
    // $('#new-slider').find('.owl-prev').html('<i class="fa fa-angle-left"></i>');
    // $('#new-slider').find('.owl-next').html('<i class="fa fa-angle-right"></i>');
    $("#client-logo").owlCarousel({
        navigation: false,
        pagination: false,
        slideSpeed: 1000,
        stopOnHover: true,
        autoPlay: true,
        items: 5,
        itemsDesktopSmall: [1024, 3],
        itemsTablet: [600, 1],
        itemsMobile: [479, 1]
    });
    var owl = $(".testimonials-carousel");
    owl.owlCarousel({
        navigation: false,
        pagination: true,
        slideSpeed: 1000,
        stopOnHover: true,
        autoPlay: true,
        items: 1,
        itemsDesktopSmall: [1024, 1],
        itemsTablet: [600, 1],
        itemsMobile: [479, 1]
    });
    var owl = $(".touch-slider");
    owl.owlCarousel({
        navigation: true,
        pagination: false,
        slideSpeed: 1000,
        stopOnHover: true,
        autoPlay: true,
        items: 1,
        itemsDesktopSmall: [1024, 1],
        itemsTablet: [600, 1],
        itemsMobile: [479, 1]
    });
    $('.touch-slider').find('.owl-prev').html('<i class="fa fa-angle-left"></i>');
    $('.touch-slider').find('.owl-next').html('<i class="fa fa-angle-right"></i>');
    $('.testimonials-carousel').find('.owl-prev').html('<i class="fa fa-angle-left"></i>');
    $('.testimonials-carousel').find('.owl-next').html('<i class="fa fa-angle-right"></i>');
    var owl;
    $(window).on('load', function() {
        owl = $("#owl-demo");
        owl.owlCarousel({
            navigation: false,
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true,
            afterInit: afterOWLinit,
            afterUpdate: afterOWLinit
        });

        function afterOWLinit() {
            $('.owl-controls .owl-page').append('<a class="item-link" />');
            var pafinatorsLink = $('.owl-controls .item-link');
            $.each(this.owl.userItems, function(i) {
                $(pafinatorsLink[i]).css({
                    'background': 'url(' + $(this).find('img').attr('src') + ') center center no-repeat',
                    '-webkit-background-size': 'cover',
                    '-moz-background-size': 'cover',
                    '-o-background-size': 'cover',
                    'background-size': 'cover'
                }).on('click', function() {
                    owl.trigger('owl.goTo', i);
                });
            });
            $('.owl-pagination').prepend('<a href="#prev" class="prev-owl"/>');
            $('.owl-pagination').append('<a href="#next" class="next-owl"/>');
            $(".next-owl").on('click', function() {
                owl.trigger('owl.next');
            });
            $(".prev-owl").on('click', function() {
                owl.trigger('owl.prev');
            });
        }
    });
    var o = $('.toggle');
    $(window).on('load', function() {
        $('.toggle').on('click', function(e) {
            e.preventDefault();
            var tmp = $(this);
            o.each(function() {
                if ($(this).hasClass('active') && !$(this).is(tmp)) {
                    $(this).parent().find('.toggle_cont').slideToggle();
                    $(this).removeClass('active');
                }
            });
            $(this).toggleClass('active');
            $(this).parent().find('.toggle_cont').slideToggle();
        });
        $(window).on('click touchstart', function(e) {
            var container = $(".toggle-wrap");
            if (!container.is(e.target) && container.has(e.target).length === 0 && container.find('.toggle').hasClass('active')) {
                container.find('.active').toggleClass('active').parent().find('.toggle_cont').slideToggle();
            }
        });
    });
    var offset = 200;
    var duration = 500;
    $(window).scroll(function() {
        if ($(this).scrollTop() > offset) {
            $('.back-to-top').fadeIn(400);
        } else {
            $('.back-to-top').fadeOut(400);
        }
    });
    $('.back-to-top').on('click', function(event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, 600);
        return false;
    })
    $("#range").ionRangeSlider({
        hide_min_max: true,
        keyboard: true,
        min: 0,
        max: 5000,
        from: 1000,
        to: 4000,
        type: 'double',
        step: 1,
        prefix: "$",
        grid: true
    });
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav'
    });
    $('.slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        centerMode: true,
        focusOnSelect: true,
        responsive: [{
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
            }
        }, ],
    });
    $("div.color-list .color").click(function(e) {
        e.preventDefault();
        $(this).parent().parent().find(".color").removeClass("active");
        $(this).addClass("active");
    });
	$("#homemansory").mpmansory(
				{
					childrenClass: 'item', // default is a div
					columnClasses: 'padding', //add classes to items
					breakpoints:{
						lg: 4, 
						md: 4, 
						sm: 6,
						xs: 12
					},
					distributeBy: { order: false, height: false, attr: 'data-order', attrOrder: 'asc' }, //default distribute by order, options => order: true/false, height: true/false, attr => 'data-order', attrOrder=> 'asc'/'desc'
					onload: function (items) {
						//make somthing with items
					} 
				}
			);
}(jQuery));