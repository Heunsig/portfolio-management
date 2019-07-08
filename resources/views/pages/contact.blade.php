@extends('main')

@section('title', '- Contact')

@section('content')
<!-- GOOGLE MAP -->
<section class="module-map">
	<!-- ADD YOUR ADDRESS HERE -->
	<div id="map" data-address="Koreatown, LA, CA"></div>
</section>
<!-- /GOOGLE MAP -->

<!-- CONTACT -->
<section class="module">
	<div class="container-fluid container-custom">

		<!-- MODULE TITLE -->
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<h2 class="module-title font-alt">Let’s talk</h2>
				<!--<p class="module-subtitle">A collection of textile samples lay spread out on the table – Samsa was a travelling salesman – and above it there hung a picture that he had recently cut.</p>-->
			</div>
		</div>
		<!-- /MODULE TITLE -->

		<div class="row">
			<div class="col-sm-12">
				@if (Session::has('success'))

					<div class="alert alert-success" role="alert">
						<stong>Success:</stong> {{ Session::get('success') }}
					</div>

				@endif

				@if (count($errors) > 0)
					<div class="alert alert-danger" role="alert">
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
			</div>
			<div class="col-sm-8">

				{{ Form::open(['route'=>'admin.message.store', 'method'=>'POST', 'id'=>'contact-form', 'role'=>'form']) }}
					<div class='form-group'>
						{{ Form::label('name', 'Name', ['class'=>'sr-only']) }}
						{{ Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Name*', 'required'=>'required', 'data-validation-required-message'=>'Please enter your name.']) }}
						<p class="help-block text-danger"></p>
					</div>
					<div class='form-group'>
						{{ Form::label('email', 'Your Email', ['class'=>'sr-only']) }}
						{{ Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'Your E-mail*', 'required'=>'required', 'data-validation-required-message'=>'Please enter your email address.']) }}
						<p class="help-block text-danger"></p>
					</div>
					<div class='form-group'>
						{{ Form::textarea('message', null, ['row'=>'7', 'class'=>'form-control', 'placeholder'=>'Message*', 'required'=>'required', 'data-validation-required-message'=>'Please enter your message.']) }}
						<p class="help-block text-danger"></p>
					</div>
					<div class="text-center">
						{{ Form::submit('Submit', ['class'=>'btn btn-block btn-round btn-dark']) }}
					</div>
				{{ Form::close() }}
				

			</div><!-- .col-* -->

			<div class="col-sm-4">

				<div class="iconbox iconbox-left m-t-0 m-t-sm-40">
					<div class="iconbox-icon">
						<span class="icon-megaphone"></span>
					</div>
					<div class="iconbox-header">
						<h4 class="iconbox-title font-alt">Say Hello</h4>
					</div>
					<div class="iconbox-content">
						<p>Email: heun3344@gmail.com<br>Phone: +1 213 760 1587</p>
					</div>
				</div>

				<!--<div class="iconbox iconbox-left">
					<div class="iconbox-icon">
						<span class="icon-map"></span>
					</div>
					<div class="iconbox-header">
						<h4 class="iconbox-title font-alt">Where to meet</h4>
					</div>
					<div class="iconbox-content">
						<p>Black Company<br> 23 Greate Street<br> Los Angeles, 12345 LS</p>
					</div>
				</div>-->

			</div><!-- .col-* -->

		</div>

	</div>
</section>
<!-- /CONTACT -->

@endsection

@push('scripts')
	{{ Html::script('assets/front/lib/js/jqBootstrapValidation.js') }}
	{{ Html::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyBceNl50o3BU6LrsIGJxSL9tKKvqBKIeVs') }}
	{{ Html::script('assets/front/lib/js/gmap3.min.js') }}
	{{ Html::script('assets/front/js/contactScript.js') }}
@endpush