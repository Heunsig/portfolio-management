<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	@include('admin.partials._head')
</head>
<body>
	@include('admin.partials._nav')
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
	@include('admin.partials._scripts')
</body>
</html>