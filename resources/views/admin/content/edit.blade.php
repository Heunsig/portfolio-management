@extends('admin.main')

@section('title', '- Edit content')

@section('content')
{{ Form::model($content, ['route'=>['admin.content.update', $content->id], 'method'=>'PUT', 'files'=>true, 'class'=>'ui form catcha c-form', 'id'=>'form']) }}
<div class="ui grid">
  <div class="sixteen wide column">
    <div class="ui grid catcha c-header-main">
      <div class="twelve wide column">
        <h1 class="ui header catcha c-header-title">Content</h1>
        <div class="ui breadcrumb">
          <a class="section">Home</a>
          <div class="divider"> / </div>
          <a class="section" href="{{ route('admin.content.index') }}">Content</a>
          <div class="divider"> / </div>
          <a class="section" href="{{ route('admin.content.show', $content->id) }}">View content: {{ $content->id }}</a>
          <div class="divider"> / </div>
          <div class="section active">Edit</div>
        </div>
      </div>
      <div class="four wide column right aligned">
        <a href="{{ route('admin.content.show', $content->id)}}" class="ui grey button">Back to View Page</a>
      </div>
    </div>
  </div>
  <h2 class="ui header">
    Edit content
  </h2>
  <div class="sixteen wide column">
    <div class="ui header top attached">ID: {{ $content->id }}</div>
    <div class="ui segment attached">
      <div class="field">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', null) }}
      </div>
      <div class="field">
        {{ Form::label('subtitle', 'Subtitle') }}
        {{ Form::text('subtitle', null) }}
      </div>
      <div class="field">
        {{ Form::label('content', 'Content') }}
        {{ Form::textarea('content', null) }}
      </div>
    </div>
    <div class="catcha c-button-box">
      <div class="space"></div>
      <div class="actions">
        {{ Form::submit('Save', ['class'=>'ui button primary', 'id'=>'btnUpdate']) }}
      </div>
    </div>
  </div>
</div>
{{ Form::close() }}
@endsection
@push('scripts')
<script>
  $('#btnUpdate').on('click', e => {
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