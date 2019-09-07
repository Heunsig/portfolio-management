@extends('admin.main')

@section('title','- Create Content')

@section('content')
{{ Form::open(['route'=>'admin.content.store', 'method'=>'POST', 'files'=>true, 'class'=>'ui form catcha c-form']) }}
<div class="ui grid">
  <div class="sixteen wide column">
    <div class="ui grid catcha c-header-main">
      <div class="twelve wide column">
        <h1 class="ui header catcha c-header-title">Content</h1>
        <div class="ui breadcrumb">
          <a class="section">Home</a>
          <div class="divider"> / </div>
          <a class="section">Content</a>
          <div class="divider"> / </div>
          <div class="section active">Create New Content</div>
        </div>
      </div>
      <div class="four wide column right aligned">
        <a href="{{ route('admin.content.index') }}" class="ui grey button">Back to list</a>
      </div>
    </div>
  </div>
  <h2 class="ui header">Create New Content</h2>
  <div class="ui sixteen wide column">
    <div class="ui segment">
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
        {{ Form::submit('Save', ['class'=>'ui button primary']) }}
      </div>
    </div>
  </div>
</div>
{{ Form::close() }}
@endsection