<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	@include('partials._head')
</head>
<body>
	<!-- PRELOADER -->
	<div class="page-loader">
		<div class="loader">Loading...</div>
	</div>
	<!-- /PRELOADER -->

	@include('partials._nav')

	<!-- WRAPPER -->
	<div class="wrapper">

		@yield('content')

		<hr class="divider">

		@include('partials._footer')

	</div>
	<!-- /WRAPPER -->

	@include('partials._scripts')
</body>
</html>

