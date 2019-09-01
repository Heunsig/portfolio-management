@if (Session::has('success'))
	<div class="ui positive message catcha c-mt-1">
		<i class="close icon"></i>
	  <div class="header">
	    Success
	  </div>
	  <p>{{ Session::get('success') }}</p>
	</div>
@endif

@if (count($errors) > 0)
	<div class="ui error message">
	  <i class="close icon"></i>
	  <div class="header">
	    Couldn't process the transaction because of errors below.
	  </div>
	  <ul class="list">
	    @foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
	  </ul>
	</div>
	{{-- <div class="alert alert-danger" role="alert">
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div> --}}
@endif


@push('scripts')
<script>
	$('.message .close').on('click', function() {
    $(this).closest('.message').transition('fade')
  })
</script>
@endpush
