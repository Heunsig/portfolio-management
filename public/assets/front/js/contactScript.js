function documentReady(){
	googleMap();

	/* ---------------------------------------------- /*
	 * Contact validation
	/* ---------------------------------------------- */
	$('#contact-form').find('input,textarea').jqBootstrapValidation({
		preventSubmit: true
	});
}

/* ---------------------------------------------- /*
 * Google Map
/* ---------------------------------------------- */
function googleMap(){

	var mapID = $('#map');
	var isDraggable = Math.max($(window).width(), window.innerWidth) > 480 ? true : false;

	mapID.each(function() {

		var GMaddress = mapID.attr('data-address');

		mapID.gmap3({
			action: "init",
			marker: {
				address: GMaddress,
				options: {
					icon: '/assets/front/images/map-icon.png'
				}
			},
			map: {
				options: {
					zoom: 14,
					zoomControl: true,
					zoomControlOptions: {
						style: google.maps.ZoomControlStyle.SMALL
					},
					mapTypeControl: true,
					scaleControl: false,
					scrollwheel: false,
					streetViewControl: false,
					draggable: isDraggable,
					styles: [
						{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},
						{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},
						{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},
						{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},
						{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},
						{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},
						{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},
						{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},
						{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},
						{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},
						{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},
						{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},
						{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},
						{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}
					]
				}
			}
		});

	});
}
