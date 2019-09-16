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

	$("#btnLogout").on('click', e => {
		e.preventDefault()

		var form = $('<form></form>')
		var token = $('<input/>')
		token.attr('type', 'hidden')
		token.attr('name', '_token')
		token.val($('meta[name="csrf-token"]').attr('content'))

		form.attr('action', '/admin/logout')
		form.attr('method', 'POST')
		form.append(token)
		form.appendTo('body')

		$('#blackout').dimmer({
			closable: false,
			onShow: function () {
				form.submit()
			}
		}).dimmer('show')
		
	})

	function activeMenuOnMainNav () {
		var breadcrumb = $('.breadcrumb')
		var currentPage = breadcrumb.children().eq(2)[0].innerText.toLowerCase()

		$('#mainNav').find('.item').each((i, e) => {
			console.log(e)
			if (e.innerText.toLowerCase() === currentPage) {
				$(e).addClass('active')
				return false
			}
		})
	}

	activeMenuOnMainNav()
</script>

@stack('scripts')