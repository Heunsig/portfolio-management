<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Catcha Admin Login</title>
	{{ Html::style('assets/common_lib/bootstrap/css/bootstrap.min.css') }}
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				@if (Session::has('fail'))
					<div class="alert alert-danger" role="alert">
						<stong>Login failed :</stong> {{ Session::get('fail') }}
					</div>
				@endif
				{{ Form::open(['route'=>'admin.login', 'method'=>'POST']) }}
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Email*</span>
					<input type="text" name="email" class="form-control" aria-describedby="basic-addon1">
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Password*</span>
					<input type="password" name="password" class="form-control" aria-describedby="basic-addon1">
				</div>
				<input type="submit" class="btn btn-block btn-primary" value="Login"/>
				{{ Form::close() }}
			</div>
		</div>
	</div>
</body>
</html>