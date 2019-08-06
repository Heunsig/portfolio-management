<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		@include('admin.partials._head')
	</head>
	<body>
		<div class="ui fluid container">
			<div class="ui top fixed menu">
			  <div class="item">
			    <img src="https://semantic-ui.com/images/logo.png"/>
			  </div>
			  <a class="item active">Portfolio</a>
			  <a class="item">Type</a>
			  <a class="item">Icon</a>
			  <div class="right menu">
			    <a class="item">Sign Out</a>
			  </div>
			</div>
			<div class="c-content">
				@yield('content')
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
	</body>
</html>