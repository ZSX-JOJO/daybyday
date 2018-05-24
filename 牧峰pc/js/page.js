$(function(){
	$('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
        && location.hostname == this.hostname) {
            var $target = $(this.hash);
            $target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');
            if ($target.length) {
                var targetOffset = $target.offset().top-$('#header').outerHeight();
                $('html,body').animate({scrollTop: targetOffset}, 500);
                return false;
            }
        }
    });
	setScroll();
	$(window).scroll(setScroll);
	
	var mainImg = new Swiper ('.mainImg .swiper-container', {
		speed: 600,
		autoplay: {
			delay: 4000,
			disableOnInteraction: false,
		},
		navigation: {
		  nextEl: '.mainImg .next',
		  prevEl: '.mainImg .prev',
		},
		pagination: {
			el: '.mainImg .pagination',
			clickable: true
		},
	});
	
	var $grid = $('.grid').masonry({
		columnWidth: '.grid-sizer',
		percentPosition: true
	});
	$grid.imagesLoaded().progress( function() {
	  $grid.masonry('layout');
	});
	
	var brandSlider = new Swiper ('.brandSlider .swiper-container', {
		speed: 300,
		autoplay: {
			delay: 3000,
			disableOnInteraction: false,
		},
		slidesPerView: 'auto',
		slidesPerGroup: 1,
		spaceBetween: 40,
		navigation: {
		  nextEl: '.brandSlider .next',
		  prevEl: '.brandSlider .prev',
		}
	});
	
	
});

function setScroll(){
	var off = $('#header').outerHeight()+2;
	var sTop = $(document).scrollTop();
	var off01 = $('#container').offset().top;
	var off02 = $('#function').offset().top;
	var off03 = $('#photo').offset().top;
	var off04 = $('#service').offset().top;
	var off05 = $('#footer').offset().top;

	if(sTop+off >=off01){
		$('#gNavi li').removeClass('current').eq(0).addClass('current');
	}

	if(sTop+off >= off02){
		$('#gNavi li').removeClass('current').eq(1).addClass('current');
	}

	if(sTop+off >= off03){
		$('#gNavi li').removeClass('current').eq(2).addClass('current');
	}
	
	if(sTop+off >= off04){
		$('#gNavi li').removeClass('current').eq(3).addClass('current');
	}
	
	if(sTop+off >= off05){
		$('#gNavi li').removeClass('current').eq(4).addClass('current');
	}
	
}