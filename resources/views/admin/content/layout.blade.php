@extends('admin.main')

@section('content')
<div class="ui grid">
  <div class="sixteen wide column">
    <div class="ui grid catcha c-header-main">
      <div class="twelve wide column">
        <h1 class="ui header catcha c-header-title">Content</h1>
        <div class="ui breadcrumb">
          @yield('content.breadcrumb')
        </div>
      </div>
      <div class="four wide column right aligned">
        @yield('content.topButtons')
      </div>
    </div>
  </div>
  <div class="sixteen wide column">
    @yield('content.content')
  </div>
</div>
@endsection