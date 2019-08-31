@extends('admin.main')

@section('title', '- Message '. $message->name)

@section('content')
<div class="ui grid">
	<div class="sixteen wide column">
		<div class="ui grid catcha c-header-main">
			<div class="twelve wide column">
				<h1 class="ui header catcha c-header-title">Message</h1>
				<div class="ui breadcrumb">
				  <a class="section">Home</a>
				  <div class="divider"> / </div>
				  <a class="section" href="{{ route('admin.message.index') }}">Message</a>
				  <div class="divider"> / </div>
				  <div class="section  active">View: {{ $message->id }}</div>
				</div>
			</div>
			<div class="four wide column right aligned">
				<a href="{{ route('admin.message.index') }}" class="ui primary button">Back to list</a>
				{{ Form::open(['route'=>['admin.message.destroy', $message->id], 'method'=>'DELETE', 'class'=>'catcha c-alignment-inline', 'id'=>'formDeleteMessage']) }}
					<button type="button" class="ui red button" id="btnDeleteMessage">Delete</button>
				{{ Form::close() }}
			</div>
		</div>
	</div>
	<h2>Read message #{{ $message->id }} from {{ $message->name }}</h2>
	<div class="sixteen wide column">
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
	</div>
</div>



{{-- <div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="{{ route('admin.message.index') }}">Message</a></li>
			<li class="active">View</li>
		</ol>
	</div>
	<div class="col-md-12">
		<div class="page-header">
			<h1>{{ $message->name }}</h1>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-12">{{ $message->message }}</div>
				</div>
			</div>	
			<div class="col-md-4">
				<div class="list-group">
					<div href="#" class="list-group-item">
						<h4 class="list-group-item-heading">Email</h4>
						<p class="list-group-item-text">{{ $message->email }}</p>
					</div>
					<div href="#" class="list-group-item">
						<h4 class="list-group-item-heading">Created At</h4>
						<p class="list-group-item-text">{{ $message->created_at }}</p>
					</div>
					<div href="#" class="list-group-item">
						<h4 class="list-group-item-heading">Updated At</h4>
						<p class="list-group-item-text">{{ $message->updated_at }}</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						{{ Form::open(['route'=>['admin.message.destroy', $message->id], 'method'=>'DELETE']) }}
						<button class="btn btn-danger btn-block">Delete</button>
						{{ Form::close() }}
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<a href="{{ route('admin.message.index') }}" class="btn btn-default btn-block space-margin-top"><< See All of messages</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> --}}

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