@extends('admin.main')

@section('title','- Content')

@section('content')

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
          <div class="section active">View: {{ $content->id }}</div>
        </div>
      </div>
      <div class="four wide column right aligned">
        <a class="ui primary button" href="{{ route('admin.content.index') }}">
          Back to list
        </a>
        <a class="ui orange button" href="{{ route('admin.content.edit', $content->id) }}">
          Edit
        </a>
        {{ Form::open(['route'=>['admin.content.destroy', $content->id], 'method'=>'DELETE', 'class'=>'catcha c-alignment-inline', 'id'=>'formToDelete']) }}
          <button class="ui red button" id="btnDelete">Delete</button>
        {{ Form::close() }}
      </div>
    </div>
  </div>
  <h2 class="ui header">
    Content #{{ $content->id }}'s details
  </h2>
  <div class="sixteen wide column">
    <div class="ui segment">
      <div class="ui grid">
        <div class="row">
          <div class="column">
            <div class="ui tiny header">Title</div>
            <p>{{ $content->title }}</p>
          </div>
        </div>
        <div class="row">
          <div class="column">
            <div class="ui tiny header">Sub title</div>
            <p>{{ $content->subtitle }}</p>
          </div>
        </div>
        <div class="row">
          <div class="column">
            <div class="ui tiny header">Content</div>
            <p>
              {!! $content->content !!}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@component('admin.components.modals.checkingModal')
  @slot('id')
    modalDeleteContent
  @endslot
  @slot('title')
    Warning
  @endslot
  Do you want to delete this content?
@endcomponent

@endsection
@push('scripts')
<script>
  $('#btnDelete').on('click', e => {
  e.preventDefault()

  $('#modalDeleteContent').modal({
    closable: false,
    onApprove: () => {
      $('#modalDeleteContent > .actions > button').addClass('loading disabled')
      $('#formToDelete').submit()
      return false
    }
  }).modal('show')
})
</script>
@endpush