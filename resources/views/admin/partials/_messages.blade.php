@if (Session::has('success'))
	<div class="ui positive message catcha c-mt-1">
		<i class="close icon"></i>
	  <div class="header">
	    Success
	  </div>
	  <p>{{ Session::get('success') }}</p>
	</div>
@endif

@if (count($errors) > 0 || Session::has('errors'))
	<div class="ui error message catcha c-mt-1">
	  <i class="close icon"></i>
	  <div class="header">
	    Couldn't process the transaction because of errors below.
	  </div>
	  <ul class="list">
	  	@if(is_object($errors))
		    @foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			@else
				@if (Session::has('errors'))
					@foreach (Session::get('errors') as $error)
						<li>{{ $error }}</li>
					@endforeach
				@endif
			@endif
	  </ul>
	</div>
@endif

@push('scripts')
<script>
	$('.message .close').on('click', function() {
    $(this).closest('.message').transition('fade')
  })
</script>
@endpush
