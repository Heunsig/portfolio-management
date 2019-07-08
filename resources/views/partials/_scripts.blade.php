<!-- JAVASCRIPT FILES -->
<script src="{{url('/')}}/assets/common_lib/jquery/jquery-2.1.4.min.js"></script>
<script src="{{url('/')}}/assets/common_lib/bootstrap/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/vue@2.3.3/dist/vue.min.js"></script>
<script src="{{url('/')}}/assets/common_lib/imagesloaded.pkgd.js"></script>
<script src="{{url('/')}}/assets/common_lib/backbone/underscore-min.js"></script>
<script src="{{url('/')}}/assets/common_lib/backbone/backbone-min.js"></script>
<script src="{{url('/')}}/assets/common_lib/backbone/mustache.min.js"></script>
<script src="{{url('/')}}/assets/front/lib/js/jquery.superslides.min.js"></script>
<script src="{{url('/')}}/assets/front/lib/js/isotope.pkgd.min.js"></script>
<!--<script src="assets/front/js/jquery.magnific-popup.min.js"></script>-->
<!--<script src="assets/front/js/owl.carousel.min.js"></script>-->
<script src="{{url('/')}}/assets/front/lib/js/appear.js"></script>
<script src="{{url('/')}}/assets/front/lib/js/smoothscroll.js"></script>
<script src="{{url('/')}}/assets/front/lib/js/submenu-fix.js"></script>
{{ Html::script('/assets/front/js/commonScript.js') }}

@stack('scripts')

<script>
(function($){

	"use strict";

	/* ---------------------------------------------- /*
	 * Preloader
	/* ---------------------------------------------- */
	var win = $(window);
	win.load(function() {
		$('.page-loader').delay(350).fadeOut('slow');
	});

	$(document).ready(function(){
		if(typeof commonDocumentReady === 'function'){
			commonDocumentReady();
		}

		if(typeof documentReady === 'function'){
			documentReady();
		} 
	});

})(jQuery);	
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-92175290-2', 'auto');
  ga('send', 'pageview');
</script>