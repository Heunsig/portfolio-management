
{{-- {{ Html::script('assets/common_lib/jquery/jquery-2.1.4.min.js') }}
{{ Html::script('assets/common_lib/jquery/jquery-ui.min.js') }}
{{ Html::script('assets/common_lib/bootstrap/js/bootstrap.min.js') }} --}}
<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous">
 </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
<script>
	$.ajaxSetup({
    headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
	})
</script>

@stack('scripts')

{{-- <script>
	$(document).ready(function(){
		activeCurrentNav();

		/*
		 *	ajax set headers token (Laravel need this token)
		 */
		if(typeof documentReady === 'function'){
			$.ajaxSetup({
			        headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
			});
			
			documentReady();
		}
	});

	function activeCurrentNav(){
		// Common Script
		var breadcrumb_content = $('.breadcrumb').children().eq(0);
		var current_page = breadcrumb_content.text().toLowerCase();

		$('#main_nav').children("li[role='presentation']").each(function(i,e){
			var a = $(e).children('a').text().toLowerCase();
				if($(e).children('a').text().toLowerCase() === current_page){
					$(e).addClass('active');
					return false;
				}
		});
	}
</script> --}}