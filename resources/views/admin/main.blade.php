<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		@include('admin.partials._head')
	</head>
	<body class="catcha c-body">
		<div class="ui fluid container">
			<div class="ui top fixed menu" id="mainNav">
			  <div class="item">
			    <img src="https://semantic-ui.com/images/logo.png"/>
			  </div>
			  <a class="item" href="{{ route('admin.portfolio.index') }}">Portfolio</a>
			  <a class="item" href="{{ route('admin.type.index') }}">Type</a>
			  <a class="item" href="{{ route('admin.icon.index') }}">Icon</a>
			  <div class="right menu">
			  	<a class="item" href="{{ route('admin.message.index') }}">Message</a>
			    <a class="item" herf="{{ route('admin.logout') }}">Sign Out</a>
			  </div>
			</div>
			<div class="catcha c-content">
				@include('admin.partials._messages')
				@yield('content')
			</div>
		</div>
		
		<div class="ui page dimmer">
		  <div class="content">
		    <div class="ui text loader">Loading</div>
		  </div>
		</div>
		{{-- @include('admin.partials._nav')
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-3">
					@include('admin.partials._nav_left')
				</div>
				<div class="col-md-9">
					<div class="row">
						<div class="col-md-12">
							@include('admin.partials._messages')
						</div>
					</div>
					@yield('content')
				</div>
			</div>
		</div>		
		@include('admin.partials._scripts') --}}
		@include('admin.partials._scripts')
	</body>
</html>