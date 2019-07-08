function commonDocumentReady(){
	var win = $(window);

	var moduleHero = $('.module-hero, .module-map'),
			mobileTest;

		/* ---------------------------------------------- /*
		 * Mobile detect
		/* ---------------------------------------------- */

		if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
			mobileTest = true;
		} else {
			mobileTest = false;
		}

		/* ---------------------------------------------- /*
		 * Full height module
		/* ---------------------------------------------- */

		win.resize(function() {
			if (moduleHero.length > 0) {
				if (moduleHero.hasClass('js-fullheight')) {
					moduleHero.height(win.height());
				} else {
					moduleHero.height(win.height() * 0.65);
				}
			}
		}).resize();

		/* ---------------------------------------------- /*
		 * Intro slider setup
		/* ---------------------------------------------- */

		$('#slides').superslides({
			play: 10000,
			animation: 'fade',
			animation_speed: 800,
			pagination: true,
		});

		/* ---------------------------------------------- /*
		 * Setting background of modules
		/* ---------------------------------------------- */

		var modules = $('.module-hero, .module, .module-sm, .module-xs, .sidebar');

		modules.each(function() {
			if ($(this).attr('data-background')) {
				$(this).css('background-image', 'url(' + $(this).attr('data-background') + ')');
			}
		});

		/* ---------------------------------------------- /*
		 * Parallax
		/* ---------------------------------------------- */

		if (mobileTest === true) {
			modules.css({'background-attachment': 'scroll'});
		}

		/* ---------------------------------------------- /*
		 * Youtube video background
		/* ---------------------------------------------- */

		/*$(function(){
			$('.video-player').mb_YTPlayer();
		});*/

		/* ---------------------------------------------- /*
		 * Portfolio
		/* ---------------------------------------------- */
		/*var filters   = $('#filters'),
			worksgrid = $('#works-grid');

		$('a', filters).on('click', function() {
			var selector = $(this).attr('data-filter');
			$('.current', filters).removeClass('current');
			$(this).addClass('current');
			worksgrid.isotope({
				filter: selector
			});
			return false;
		});*/

		/*win.on('resize', function() {
			worksgrid.imagesLoaded(function() {
				worksgrid.isotope({
					layoutMode: 'masonry',
					itemSelector: '.work-item',
					transitionDuration: '0.3s',
				});
			});
		}).resize();*/

		/* ---------------------------------------------- /*
		 * Team hover
		/* ---------------------------------------------- */

		var team_item = $('.team-item');

		team_item.mouseenter(function(){
			$(this).addClass('js-hovered');
			team_item.filter(':not(.js-hovered)').addClass('js-fade');
		});

		team_item.mouseleave(function(){
			$(this).removeClass('js-hovered');
			team_item.removeClass('js-fade');
		});

		/* ---------------------------------------------- /*
		 * Owl sliders
		/* ---------------------------------------------- */

		/*$('.slider').owlCarousel({
			stopOnHover:     !0,
			singleItem:      !0,
			autoHeight:      !0,
			navigation:      !0,
			pagination:      !1,
			slideSpeed:      400,
			paginationSpeed: 1000,
			goToFirstSpeed:  2000,
			autoPlay:        3000,
			navigationText: [
				'<i class="fa fa-angle-left"></i>',
				'<i class="fa fa-angle-right"></i>'
			],
		});

		$('.slider-reviews').owlCarousel({
			stopOnHover:     !0,
			singleItem:      !0,
			autoHeight:      !0,
			slideSpeed:      400,
			navigation:      !0,
			pagination:      !1,
			paginationSpeed: 1000,
			goToFirstSpeed:  2000,
			autoPlay:        3000,
			navigationText: [
				'<img src="assets/images/arrow-l.png" alt="arrow">',
				'<img src="assets/images/arrow-r.png" alt="arrow">'
			],
		});

		$('.slider-clients').owlCarousel({
			stopOnHover:     !0,
			singleItem:      !1,
			autoHeight:      !0,
			navigation:      !1,
			pagination:      !1,
			slideSpeed:      400,
			paginationSpeed: 1000,
			goToFirstSpeed:  2000,
			autoPlay:        3000,
			navigationText: [
				'<i class="fa fa-angle-left"></i>',
				'<i class="fa fa-angle-right"></i>'
			],
		});*/

		/* ---------------------------------------------- /*
		 * Progress bars, counters animations
		/* ---------------------------------------------- */

		$('.progress-bar').each(function() {
			$(this).appear(function() {
				var percent = $(this).attr('aria-valuenow');
				$(this).animate({'width' : percent + '%'});
				$(this).find('.progress-value').countTo({from: 0, to: percent, speed: 900, refreshInterval: 30});
			});
		});

		$('.counter').each(function() {
			$(this).appear(function() {
				var number = $(this).find('.counter-timer').attr('data-to');
				$(this).find('.counter-timer').countTo({from: 0, to: number, speed: 1500, refreshInterval: 30});
			});
		});

		/* ---------------------------------------------- /*
		 * Gallery
		/* ---------------------------------------------- */

		/*$('.gallery-item a').magnificPopup({
			type: 'image',
			gallery: { enabled: true },
		});*/

		/* ---------------------------------------------- /*
		 * A jQuery plugin for fluid width video embeds
		/* ---------------------------------------------- */

		/*$('body').fitVids();*/

		/* ---------------------------------------------- /*
		 * Scroll Animation
		/* ---------------------------------------------- */

		$('.anim-scroll').on('click', function(e) {
			var target = this.hash;
			var $target = $(target);
			$('html, body').stop().animate({
				'scrollTop': $target.offset().top
			}, 900, 'swing');
			e.preventDefault();
		});

		/* ---------------------------------------------- /*
		 * Scroll top
		/* ---------------------------------------------- */

		$('a[href="#top"]').on('click', function() {
			$('html, body').animate({ scrollTop: 0 }, 'slow');
			return false;
		});
}

function activeTypeBtn(){
	var filters   = $('#filters'),
		worksgrid = $('#works-grid');

		$('a', filters).on('click', function() {
			var selector = $(this).attr('data-filter');
			$('.current', filters).removeClass('current');
			$(this).addClass('current');
			worksgrid.isotope({
				filter: selector
			});
			return false;
		});
}

function afterImagesLoaded(){
	var win = $(window);
	var worksgrid = $('#works-grid');

		win.on('resize', function() {
				worksgrid.imagesLoaded(function() {
					worksgrid.isotope({
						layoutMode: 'masonry',
						itemSelector: '.work-item',
						transitionDuration: '0.3s',
					});
				});
		}).resize();
}