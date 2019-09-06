@extends('admin.account.index')

@section('account.breadcrumb')
<div id="breadCrumbAccount" class="ui breadcrumb">
  <a class="section">Home</a>
  <div class="divider"> / </div>
  <a class="section">Account</a>
  <div class="divider"> / </div>
  <div class="section active">API Key</div>
</div>
@endsection

@section('account.actions')

@endsection

@section('account.content')
<h2 class="ui header">API Key</h2>
<h3 class="ui header attached">Active API key list</h3>
<div class="ui segment attached">
  <div class="catcha c-button-box">
    <div class="space"></div>
    <div class="actions">
      <a class="ui primary button" href="{{ route('admin.account.apikeys.create') }}">Create New API Key</a>
    </div>
  </div>  
  <table class="ui celled table">
    <thead>
      <tr>
        <th width="350">Key</th>
        <th>Referrers</th>
        <th width="190">Created at</th>
        <th width="120"></th>
      </tr>
    </thead>
    <tbody>
      @foreach($apikeys as $apikey)
      <tr>
        <td>
          <a href="{{ route('admin.account.apikeys.show', $apikey->key) }}">{{ $apikey->key }}</a>
        </td>
        <td>
          @foreach($apikey->referrers as $index => $referrer)
            {{ $referrer->referrer . ($index !== count($apikey->referrers) - 1 ? ',' : '') }}
          @endforeach
        </td>
        <td>{{ $apikey->created_at }}</td>
        <td class="center aligned">
          {{ Form::open(['route'=>['admin.account.apikeys.destroy', $apikey->key], 'method'=>'DELETE', 'class'=>'catcha c-alignment-inline __formToDelete']) }}
            <button type="button" class="ui red tiny button __btnDelete">Delete</button>
          {{ Form::close() }}
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@component('admin.components.modals.checkingModal')
  @slot('id')
    modalDeleteAPIKey
  @endslot
  @slot('title')
    Warning
  @endslot
  Do you want to delete this API Key?
@endcomponent

@endsection

@push('scripts')
<script>
  $('.__btnDelete').on('click', e => {
    e.preventDefault()
    // console.log($(e.target).parent().attr('class'))

    $('#modalDeleteAPIKey').modal({
      closable: false,
      onApprove: function () {
        $('#modalDeleteAPIKey > .actions > button').addClass('loading disabled')
        $(e.target).parent().submit()
        return false
      }
    }).modal('show')
  })
</script>
@endpush