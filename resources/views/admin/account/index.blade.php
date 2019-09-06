@extends('admin.main')

@section('title','- Message')

@section('content')
<div class="ui grid">
  <div class="sixteen wide column">
    <div class="ui grid catcha c-header-main">
      <div class="twelve wide column">
        <h1 class="ui header catcha c-header-title">
          Account
        </h1>
        @yield('account.breadcrumb')
      </div>
      <div class="four wide column right aligned">
        @yield('account.actions')
      </div>
    </div>
  </div>
  <div class="sixteen wide column">
    <div class="ui grid">
      <div class="three wide column">
        <div id="subNav" class="ui vertical pointing menu">
          <a class="item" href="{{ route('admin.account.index') }}">
            Overview
          </a>
          <a class="item" href="{{ route('admin.account.security') }}">
            Security
          </a>
          <a class="item" href="{{ route('admin.account.apikeys.index') }}">
            API Key
          </a>
        </div>
      </div>
      <div class="thirteen wide column">
        @yield('account.content')
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  (function () {
    var breadcrumb = $('#breadCrumbAccount')
    var currentPage = breadcrumb.children().eq(4)[0].innerText.toLowerCase()

    $('#subNav').find('.item').each((i, e) => {
      if (e.innerText.toLowerCase() === currentPage) {
        $(e).addClass('active')
        return false
      }
    })
  })()
</script>
@endpush