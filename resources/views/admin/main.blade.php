<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		@include('admin.partials._head')
	</head>
	<body class="catcha c-body">
		<div class="ui fluid container">
			@include('admin.partials._nav')
			<div class="catcha c-content">
				@include('admin.partials._messages')
				@yield('content')
			</div>
		</div>
		
		<div class="ui page dimmer" id="blackout">
		  <div class="content">
		    <div class="ui text loader">Loading</div>
		  </div>
		</div>

		@include('admin.partials._scripts')
	</body>
</html>