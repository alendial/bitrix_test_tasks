jQuery(document).ready(function($) {
	$('[data-svg]').each(function(index, el) {
		$.get($(el).attr('data-svg'), function(data) {
			$(el).html(data);
		}, 'html');
	});	
});


jQuery(document).ready(function($) {
	try {
		$.browserSelector();
		if($("html").hasClass("chrome")) {
			$.smoothScroll();			
		}
	} catch(err) {};
});


jQuery(document).ready(function($) {	
	$('a[href*="#"].anchor').bind("click", function(e){	
		var anchor = $(this);
		setTimeout(function() {
			if ($(anchor.attr('href')).length>0){				
				$('html, body').stop().animate({
					scrollTop: $(anchor.attr('href')).offset().top
				}, 700);
				e.preventDefault();
			}			
		}, 200);
		return false;
	});
});


jQuery(document).ready(function($) {
	if (typeof inputmask === "function") {
		$('input[type="tel"]').inputmask("+7(999)999-99-99", {showMaskOnHover: false,showMaskOnFocus: true,clearIncomplete: true});		
	}else{

		$.getScript('https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js', function(){
			$('input[type="tel"]').inputmask("+7(999)999-99-99", {showMaskOnHover: false,showMaskOnFocus: true,clearIncomplete: true});
		});
	}
});


$(window).on('load', function(event) {
	if (typeof(ymaps) === "undefined"){
		$.getScript('http://api-maps.yandex.ru/2.1/?load=package.full&mode=release&lang=ru-RU', function(){
			YandexMap();
		});
	}else{
		YandexMap();
	}
	function YandexMap(){
		$('.c-yandex-map').each(function(index, el) {
			var element = $(el);
			var points = $.parseJSON(element.attr('data-points'));
			var center = element.attr('data-center') ? $.parseJSON(element.attr('data-center')) : points[0];

			ymaps.ready(function(){
				var map = new ymaps.Map(element[0], {					
					center: center,
					zoom: element.attr('data-zoom'),
					type: "yandex#map",
					controls: ["zoomControl"]
				});

				points.forEach(function(item, i, points){
					var poing = {};
					point={
						iconLayout: 'default#image',
						iconImageHref: item[2],
						iconImageSize: [54, 81],
						iconImageOffset: [-27, -81]
					};

					map.geoObjects.add(new ymaps.Placemark(
						[item[0], item[1]],
						{balloonContent: ''},
						point
						));
				});
			});
		});
	}
});


$(window).on('load', function(event) {	
	$.getScript("https://www.google.com/recaptcha/api.js", function() {	
		jQuery.fn.AutoRecapcha = function(options){
			options = $.extend({
				beforeElement: '[type="submit"]',
				frontendKey: '', 
				elementStyle:'',
				theme: 'light'
			}, options);

			var make = function(){
				if (options.frontendKey!='') {
					if ($(this).find('[data-google-recaptcha-sitekey]').length < 1) {
						$(this).find(options.beforeElement).before(
							'<div data-google-recaptcha-sitekey="' + options.frontendKey + '"></div>',
							);
					}
					var currentField = $(this).find('[data-google-recaptcha-sitekey]');
					currentField.attr('data-google-recaptcha-sitekey', options.frontendKey);
					currentField.attr('style', options.elementStyle);
					currentField.attr('id', 'google-recaptcha-'+Math.random().toString().replace(/[^0-9]/g, ''));	    	

					var widgetid = grecaptcha.render( currentField.attr('id') , {
						'sitekey' : currentField.attr('data-google-recaptcha-sitekey'),
						'theme' : options.theme
					});
					currentField.attr('data-widgetid', widgetid);

				}
			};	    
			return this.each(make);
		};

		setTimeout(function() {
			$('.auto-recapcha').AutoRecapcha({
				frontendKey:'6Lf4tk0UAAAAAJ10SqEMWP5rrYHXW9l9ddIS_aGn',
				elementStyle:'margin-bottom:15px;'
			});
		}, 1000);

	});
});


jQuery(document).ready(function($) {
	$('form.ajax').submit(function () {
		var form = $(this);
		var error = form.find('input.error, textarea.error');
		if (error.length<1) {
			var data = form.serialize();
			$.ajax({
				type: form.attr('method') ? form.attr('method') : 'POST',
				url: form.attr('action'),
				dataType: 'json',
				data: data,
				success: function (data) {
					if (data['success'] == true) {
						form.slideUp(400);
						form.siblings('.success').slideDown('400');
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					console.log(xhr.status);
					console.log(thrownError);
				}
			});
		}
		return false;
	});

	$('[data-toggle-show]').click(function(event) {
		var targetBlock = $($(this).attr('data-toggle-show'));
		if  (targetBlock.css('display')=="none"){
			targetBlock.fadeIn(400);
		}else{
			targetBlock.fadeOut(400);			
		}
	});

	$('[data-fadeIn]').click(function(event) {
		$($(this).attr('data-fadeIn')).fadeIn(400);
	});

	$('[data-fadeOut]').click(function(event) {
		$($(this).attr('data-fadeOut')).fadeOut(400);
	});


	$('[data-toggle-activate]').click(function(event) {
		$($(this).attr('data-toggle-activate')).toggleClass('active');
	});

	$('[data-deactivate]').click(function(event) {
		$($(this).attr('data-deactivate')).removeClass('active');
	});

	$('[data-activate]').click(function(event) {
		$($(this).attr('data-activate')).addClass('active');
	});

});