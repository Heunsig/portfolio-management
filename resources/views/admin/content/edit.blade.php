@extends('admin.content.layout')

@section('title', '- Edit content')

@section('content.breadcrumb')
  <a class="section">Home</a>
  <div class="divider"> / </div>
  <a class="section" href="{{ route('admin.contents.index') }}">Content</a>
  <div class="divider"> / </div>
  <a class="section" href="{{ route('admin.contents.show', $content->id) }}">View content: {{ $content->id }}</a>
  <div class="divider"> / </div>
  <div class="section active">Edit</div>
@endsection

@section('content.topButtons')
  <a href="{{ route('admin.contents.show', $content->id)}}" class="ui grey button">Back to View Page</a>
@endsection

@section('content.content')
  {{ Form::model($content, ['route'=>['admin.contents.update', $content->id], 'method'=>'PUT', 'files'=>true, 'class'=>'ui form catcha c-form', 'id'=>'form']) }}
    <div class="sixteen wide column">
      <h2 class="ui header">Edit content</h2>
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