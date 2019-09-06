@extends('admin.account.index')

@section('account.breadcrumb')
<div id="breadCrumbAccount" class="ui breadcrumb">
  <a class="section">Home</a>
  <div class="divider"> / </div>
  <a class="section">Account</a>
  <div class="divider"> / </div>
  <div class="section active">Security</div>
</div>
@endsection

@section('account.content')
<h2 class="ui header">Security</h2>
<h3 class="ui header top attached">Email</h3>
<div class="ui segment attached">
  <p>{{ Auth::user()->email }}</p>
</div>
<h3 class="ui header top attached">Change password</h3>
<div class="ui segment attached">
  {{ Form::open(['route'=>'admin.account.changePassword', 'method'=>'POST', 'files'=>true, 'class'=>'ui form']) }}
  <div class="ui grid">
    <div class="row">
      <div class="column">
        <div class="field">
          {{ Form::label('password', 'Password') }}
          {{ Form::password('password', null) }}
        </div>
      </div>
    </div>
    <div class="row">
      <div class="column">
        <div class="field">
          {{ Form::label('newPassword', 'New password') }}
          {{ Form::password('newPassword', null) }}
        </div>
      </div>
    </div>
    <div class="row">
      <div class="column">
        <div class="field">
          {{ Form::label('newPassword_confirmation', 'New password confirmation') }}
          {{ Form::password('newPassword_confirmation', null) }}
        </div>
      </div>
    </div>
    <div class="row">
      <div class="column">
        <div class="field">
          <div class="catcha c-button-box">
            <div class="space"></div>
            <div class="actions">
              {{ Form::submit('Save', ['class'=>'ui button primary']) }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{ Form::close() }}
</div>
@endsection