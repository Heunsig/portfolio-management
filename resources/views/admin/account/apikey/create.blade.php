@extends('admin.account.index')

@section('account.breadcrumb')
<div id="breadCrumbAccount" class="ui breadcrumb">
  <a class="section">Home</a>
  <div class="divider"> / </div>
  <a class="section">Account</a>
  <div class="divider"> / </div>
  <a class="section">API Key</a>
  <div class="divider"> / </div>
  <div class="section active">Create New API Key</div>
</div>
@endsection

@section('account.actions')
<a href="{{ route('admin.account.apikeys.index') }}" class="ui grey button">Back to list</a>
@endsection

@section('account.content')
<h2 class="ui header">Create New API Key</h2>
<h3 class="ui header top attached">
  API Key
</h3>
<div class="ui segment attached">
  <p>Automatically generated.</p>
</div>
<h3 class="ui header top attached">
  Referrers
</h3>
<div class="ui segment attached">
  <div class="catcha c-alignment-title-card">
    <div class="ui header tiny title"></div>
    <div class="actions">
      <button type="button" id="btnAddReferrer" class="ui mini primary button">Add</button>
    </div>
  </div>
  {{ Form::open(['route'=>'admin.account.apikeys.store', 'method'=>'POST', 'class'=>'ui form', 'id'=>'formCreateAPIKey']) }}
    <div class="field __fieldReferrer">
      <input type="text" name="referrers[]" placeholder='http://catchasoft.com'/>
    </div>
  {{ Form::close() }}

</div>
<div class="catcha c-button-box">
  <div class="space"></div>
  <div class="actions">
    <button type="button" id="btnSubmit" class="ui primary button">Save</button>  
  </div>
</div>
@endsection

@push('scripts')
<script>
  $('#btnAddReferrer').on('click', e => {
    e.preventDefault()

    var fieldReferrer = $('.__fieldReferrer').eq(0).clone()
    fieldReferrer.children('input[type="text"]').val('')
    fieldReferrer.appendTo('#formCreateAPIKey')
  })

  $('#btnSubmit').on('click', e => {
    e.preventDefault()
    $('#blackout').dimmer({
      closable: false,
      onShow: function () {
        $('#formCreateAPIKey').submit()
      }
    }).dimmer('show')
  })
</script>
@endpush