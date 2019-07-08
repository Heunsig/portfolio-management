<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<title>Catchasoft @yield('title')</title>

<!-- Favicons -->
<link rel="shortcut icon" href="{{url('/')}}/assets/front/images/favicon.png">
<link rel="apple-touch-icon" href="{{url('/')}}/assets/front/images/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="{{url('/')}}/assets/front/images/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="{{url('/')}}/assets/front/images/apple-touch-icon-114x114.png">

<!-- Fonts -->
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,400italic,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700' rel='stylesheet' type='text/css'>


<!-- Bootstrap core CSS -->
<link href="{{url('/')}}/assets/common_lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Icon Fonts -->
<link href="{{url('/')}}/assets/front/lib/css/font-awesome.min.css" rel="stylesheet">
<link href="{{url('/')}}/assets/front/lib/css/et-line-font.min.css" rel="stylesheet">
<link href="{{url('/')}}/assets/common_lib/semantic-icon/icon.min.css" rel="stylesheet">

<!-- Plugins -->
<!--<link href="assets/front/css/magnific-popup.css" rel="stylesheet">-->
<!--<link href="assets/front/css/owl.carousel.css" rel="stylesheet">-->
<link href="{{url('/')}}/assets/front/lib/css/superslides.css" rel="stylesheet">
<link href="{{url('/')}}/assets/front/lib/css/vertical.min.css" rel="stylesheet">

<!-- Template core CSS -->
<link href="{{url('/')}}/assets/front/lib/css/template.css" rel="stylesheet">

{{ Html::style('assets/front/css/style.css') }}

@stack('stylesheets')