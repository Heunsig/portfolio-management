@extends('admin.main')

@section('title','- Message')

@section('content')
<div class="ui grid">
  <div class="sixteen wide column">
    <div class="ui grid catcha c-header-main">
      <div class="twelve wide column">
        <h1 class="ui header catcha c-header-title">Account</h1>
        <div class="ui breadcrumb">
          <a class="section">Home</a>
          <div class="divider"> / </div>
          <div class="section active">Account</div>
        </div>
      </div>
      <div class="four wide column right aligned">

      </div>
    </div>
  </div>
  <h2>Account</h2>
  <div class="sixteen wide column">
    <div class="ui padded segment">
      {{ Form::open(['route'=>'admin.account.changePassword', 'method'=>'POST', 'files'=>true, 'class'=>'ui form']) }}
      <div class="ui grid">
        <div class="row">
          <div class="column">
            <div class="ui tiny header">Email</div>
            <p>{{ $email }}</p>
          </div>
        </div>
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
              {{ Form::submit('Save', ['class'=>'ui button primary']) }}
            </div>
          </div>
        </div>
      </div>
    </div>
    {{ Form::close() }}
  </div>
</div>
@endsection