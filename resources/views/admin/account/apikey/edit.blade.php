@extends('admin.account.index')

@section('account.breadcrumb')
<div id="breadCrumbAccount" class="ui breadcrumb">
  <a class="section">Home</a>
  <div class="divider"> / </div>
  <a class="section">Account</a>
  <div class="divider"> / </div>
  <a class="section">API Key</a>
  <div class="divider"> / </div>
  <a class="section">View API Key: {{  substr($apikey->key, 1, 5).'...' }}</a>
  <div class="divider"> / </div>
  <div class="section active">Edit</div>
</div>
@endsection

@section('account.actions')
<a href="{{ route('admin.account.apikeys.show', $apikey->key) }}" class="ui grey button">Back to View Page</a>
@endsection

@section('account.content')
<h2 calss="ui header">Edit API Key</h2>
<h3 class="ui header top attached">
  API Key
  <div class="sub header">Key is not chagable.</div>
</h3>
<div class="ui segment attached">
  <p>{{ $apikey->key }}</p>
</div>
<h3 class="ui header top attached">
  Referrers
</h3>
<div class="ui segment attached">
  <div class="ui grid">
    <div class="row">
      <div class="column">
        <div class="catcha c-alignment-title-card">
          <div class="ui header tiny title"></div>
          <div class="actions">
            <button type="button" id="btnAddReferrer" class="ui mini primary button">Add</button>
          </div>
        </div>
        {{ Form::open(['route'=>['admin.account.apikeys.update', $apikey->key], 'method'=>'PUT', 'class'=>'ui form', 'id'=>'formUpdateAPIKey']) }}
          @foreach($apikey->referrers as $referrer)
            <div class="field __fieldReferrer">
              <input type="text" name="referrers[]" value="{{ $referrer->referrer }}" placeholder='http://catchasoft.com'/>
            </div>
          @endforeach
        {{ Form::close() }}
      </div>
    </div>
  </div>
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
    fieldReferrer.appendTo('#formUpdateAPIKey')
  })

  $('#btnSubmit').on('click', e => {
    e.preventDefault()
    $('#blackout').dimmer({
      closable: false,
      onShow: function () {
        $('#formUpdateAPIKey').submit()
      }
    }).dimmer('show')
  })
</script>
@endpush