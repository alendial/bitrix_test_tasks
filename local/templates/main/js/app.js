$(window).on('load', function(event) {
	function BlockMaxHeight(selector) {
		var list = $(selector);
		list.attr('style', '');
		list.height(Math.max.apply(Math, list.map(function(index, elem) {return $(elem).height()})));
	}

	function BlocksProcess() {
		// BlockMaxHeight('.auto-list-block .list .item');
		// BlockMaxHeight('.dealer-center-list .list .item');
	}

	BlocksProcess();


	function LeadingZero(num) {
		return ('0' + num).slice(-2);
	}

	var banerSlider = $('.baner-slider');
	banerSlider.on('init', function(event, slick) {		
		var itemCount = banerSlider.find('.item').length;
		var progress = 1 / itemCount * 100;
		$('.baner-block .navs .paginator .slide-count').text('545');
		$('.baner-block .navs .paginator .slide-count').text(LeadingZero(itemCount));
		$('.baner-block .navs .progress .progress-bar').width(progress + '%');

	});
	
	banerSlider.on('beforeChange', function(event, slick, currentSlide, nextSlide){
		var itemCount = banerSlider.find('.item').length;				
		nextSlide = nextSlide+1;
		var progress = nextSlide / itemCount * 100;
		progress = parseInt(progress);		
		$('.baner-block .navs .paginator .slide-current').text(LeadingZero(nextSlide));
		$('.baner-block .navs .progress .progress-bar').width(progress + '%');
	});

	banerSlider.slick({
		slidesToShow:2,
		customPaging:20,
		slidesToScroll:1,
		arrows: true,
		dots: false,
		infinite: false,
		prevArrow: '.baner-block .navs .prev',
		nextArrow: '.baner-block .navs .next',
		responsive:[]
	});

});



$(window).on('load', function(event) {	

	// $('.auto-page-slider-block').each(function(index, el) {
	// 	var gallery = $(el);		
	// 	var slider = gallery.find('.slider');
	// 	var selector = gallery.find('.selector');

	// 	slider.slick({
	// 		arrows:true,
	// 		dots: false,
	// 		prevArrow: '<span class="prev"></span>',
	// 		nextArrow: '<span class="next"></span>'
	// 	});	

	// 	slider.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
	// 		selector.find('.item').removeClass('active');
	// 		selector.find('.item').eq(nextSlide).addClass('active');		
	// 	});

	// 	selector.find('.item').click(function(event) {
	// 		selector.find('.item').removeClass('active');
	// 		$(this).addClass('active');
	// 		slider.find('.item').removeClass('active');
	// 		slider.slick('slickGoTo', selector.find('.item').index($(this)));
	// 	});
	// });



	// $(document).scroll(function(event) {
	// 	if ($(document).scrollTop() > ($('.head-slider').height()-100)) {
	// 		$('.header.fixed').addClass('active');
	// 	}else{
	// 		$('.header.fixed').removeClass('active');
	// 	}
	// });
});