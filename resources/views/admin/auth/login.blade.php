<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Catcha Admin Login</title>
		{{ Html::style('assets/admin/css/style.css') }}
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" />
	</head>
	<body id="c-login-body">
		<div class="ui fluid container c-container">
	  	<div class="c-login-box">
	  		<h1 class="c-login-company">Catchasoft</h1>
	  		{{ Form::open(['route'=>'admin.login', 'method'=>'POST', 'class'=>'ui form warning']) }}
				  <div class="field">
				    <label class="c-login-label">E-mail</label>
				    <input type="email" name="email" placeholder="joe@catchasoft.com" />
				  </div>
				  <div class="field">
				    <label class="c-login-label">Password</label>
				    <input type="password" name="password" />
				  </div>
				  @if (Session::has('fail'))
				  <div class="ui warning message">
				    <div class="header">Login failed</div>
				    <ul class="list">
				      <li>{{ Session::get('fail') }}</li>
				    </ul>
				  </div>
					@endif
				  
				  <button class="ui submit button fluid teal">Sign in</button>
				{{ Form::close() }}
	  	</div>
		</div>
</body>
</html>