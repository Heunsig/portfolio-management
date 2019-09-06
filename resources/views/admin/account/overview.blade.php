@extends('admin.account.index')

@section('account.breadcrumb')
<div id="breadCrumbAccount" class="ui breadcrumb">
  <a class="section">Home</a>
  <div class="divider"> / </div>
  <a class="section">Account</a>
  <div class="divider"> / </div>
  <div class="section active">Overview</div>
</div>
@endsection
@section('account.content')
<h2 class="ui header">Overview</h2>
<h3 class="ui header top attached">User information</h3>
<div class="ui segment attached">
  <div class="ui grid">
    <div class="row">
      <div class="column">
        <div class="ui tiny header">Name</div>
        <p>{{ Auth::user()->name }}</p>
      </div>
    </div>
    <div class="row">
      <div class="column">
        <div class="ui tiny header">Email</div>
        <p>{{ Auth::user()->email }}</p>
      </div>
    </div>
  </div>
</div>
<h3 class="ui header top attached">Active API keys</h3>
<div class="ui segment attached">
  <table class="ui celled table">
    <thead>
      <tr>
        <th width="350">Key</th>
        <th>Referrers</th>
        <th width="200">Created at</th>
      </tr>
    </thead>
    <tbody>
      @foreach($apikeys as $apikey)
      <tr>
        <td>{{ $apikey->key }}</td>
        <td>
          @foreach($apikey->referrers as $index => $referrer)
            {{ $referrer->referrer . ($index !== count($apikey->referrers) - 1 ? ',' : '') }}
          @endforeach
        </td>
        <td>{{ $apikey->created_at }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection