<title>Catcha Portfolio @yield('title')</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- {{ Html::style('assets/common_lib/jquery/jquery-ui.min.css') }}
{{ Html::style('assets/common_lib/bootstrap/css/bootstrap.min.css') }}
{{ Html::style('assets/common_lib/semantic-icon/icon.min.css') }}
{{ Html::style('assets/admin/css/bootstrap.extend.css') }} --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" />
{{ Html::style('assets/admin/css/style.css') }}
@stack('stylesheets')