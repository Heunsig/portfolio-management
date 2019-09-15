@extends('admin.content.layout')

@section('title','- Create Content')

@section('content.breadcrumb')
  <a class="section">Home</a>
  <div class="divider"> / </div>
  <a class="section">Content</a>
  <div class="divider"> / </div>
  <div class="section active">Create New Content</div>
@endsection

@section('content.topButtons')
  <a href="{{ route('admin.contents.index') }}" class="ui grey button">Back to list</a>
@endsection

@section('content.content')
  {{ Form::open(['route'=>'admin.contents.store', 'method'=>'POST', 'files'=>true, 'class'=>'ui form catcha c-form']) }}
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
  {{ Form::close() }}
@endsection