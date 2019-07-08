@extends('admin.main')

@section('title', '- Message '. $message->name)

@section('content')
<div class="row">
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
</div>
@endsection


