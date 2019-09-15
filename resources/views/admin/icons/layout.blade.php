@extends('admin.main')

@section('title', '- Support Icons')

@section('content')
<div class="ui grid">
  <div class="sixteen wide column">
    <div class="ui grid catcha c-header-main">
      <div class="twelve wide column">
        <h1 class="ui header catcha c-header-title">Icon</h1>
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
@push('scripts')
<script>
  $('#btnSave').on('click', e => {
    e.preventDefault()
    $('.ui.page.dimmer').dimmer({
      closable: false,
      onShow: function () {
        $('form').submit()
      }
    }).dimmer('show')
  })
</script>
@endpush