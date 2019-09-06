@extends('admin.account.index')

@section('account.subtitle')
View API Key
@endsection

@section('account.breadcrumb')
<div id="breadCrumbAccount" class="ui breadcrumb">
  <a class="section">Home</a>
  <div class="divider"> / </div>
  <a class="section">Account</a>
  <div class="divider"> / </div>
  <a class="section">API Key</a>
  <div class="divider"> / </div>
  <div class="section active">View API Key: {{ substr($apikey->key, 1, 5).'...' }}</div>
</div>
@endsection

@section('account.actions')
<a href="{{ route('admin.account.apikeys.index') }}" class="ui grey button">Back to list</a>
<a href="{{ route('admin.account.apikeys.edit', $apikey->key) }}" class="ui orange button">Edit</a>
@endsection

@section('account.content')
<h2 class="ui header">View API Key</h2>
<div class="ui large header attached">API key overview</div>
<div class="ui padded segment attached">
  <div class="ui grid">
    <div class="row">
      <div class="eight wide column">
        <div class="ui tiny header">Key</div>
        <p>{{ $apikey->key }}</p>
      </div>
      <div class="eight wide column">
        <div class="ui tiny header">Created at</div>
        <p>{{ $apikey->created_at }}</p>
      </div>
    </div>
    <div class="row">
      <div class="column">
        <div class="ui tiny header">Referrers</div>
          @foreach($apikey->referrers as $referrer)
            <p>{{ $referrer->referrer }}</p>
          @endforeach
      </div>
    </div>
  </div>
</div>
@endsection
