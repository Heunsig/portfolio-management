@extends('admin.message.layout')

@section('title', '- Message '. $message->name)

@section('content.breadcrumb')
	<a class="section">Home</a>
  <div class="divider"> / </div>
  <a class="section" href="{{ route('admin.messages.index') }}">Message</a>
  <div class="divider"> / </div>
  <div class="section  active">View: {{ $message->id }}</div>
@endsection

@section('content.topButtons')
	<a href="{{ route('admin.messages.index') }}" class="ui primary button">Back to list</a>
	{{ Form::open(['route'=>['admin.message.destroy', $message->id], 'method'=>'DELETE', 'class'=>'catcha c-alignment-inline', 'id'=>'formDeleteMessage']) }}
		<button type="button" class="ui red button" id="btnDeleteMessage">Delete</button>
	{{ Form::close() }}
@endsection

@section('content.content')

	<h2>Read message #{{ $message->id }} from {{ $message->name }}</h2>
	<div class="ui padded segment">
		<div class="ui grid">
			<div class="row">
				<div class="four wide column">
					<div class="ui tiny header">Customer name</div>
					<p>{{ $message->name }}</p>
				</div>
				<div class="six wide column">
					<div class="ui tiny header">Customer email</div>
					<p>{{ $message->email }}</p>
				</div>
				<div class="four wide column">
					<div class="ui tiny header">Sent at</div>
					<p>
						{{ $message->created_at->diffForHumans() }} ({{ $message->created_at->format('Y-m-d h:m A') }})
					</p>
				</div>
			</div>
			<div class="ui divider"></div>
			<div class="row">
				<div class="column">
					<div class="ui tiny header">Content</div>
					<p>{{ $message->message }}</p>
				</div>
			</div>
		</div>
	</div>

@component('admin.components.modals.checkingModal')
	@slot('id')
		modalDeleteMessage
	@endslot
	@slot('title')
		Warning
	@endslot

	Do you want to delete this message?
@endcomponent
@endsection
@push('scripts')
	<script>
		$('#btnDeleteMessage').on('click', e => {
			e.preventDefault()

			$('#modalDeleteMessage').modal({
				closable: false,
				onApprove: () => {
					$('#modalDeleteMessage > .actions > button').addClass('loading disabled')
					$('#formDeleteMessage').submit()
					return false
				}
			}).modal('show')
		})
	</script>
@endpush