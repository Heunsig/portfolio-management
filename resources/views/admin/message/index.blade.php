@extends('admin.main')

@section('title','- Message')

@section('content')
<div class="ui grid">
	<div class="sixteen wide column">
		<div class="ui grid catcha c-header-main">
			<div class="twelve wide column">
				<h1 class="ui header catcha c-header-title">Message</h1>
				<div class="ui breadcrumb">
				  <a class="section">Home</a>
				  <div class="divider"> / </div>
				  <div class="section active">Message</div>
				</div>
			</div>
			<div class="four wide column right aligned">

			</div>
		</div>
	</div>
	<h2>Message List</h2>
	<div class="sixteen wide column">
		<div class="ui segment">
			<table class="ui very basic celled table">
				<thead>
					<tr>
						<th width="50">#</th>
						<th width="250">Customer name</th>
						<th>Email</th>
						<th width="200">Sent at</th>
						<th width="100"></th>
					</tr>
				</thead>	
				<tbody>
					@if(count($messages))
						@foreach($messages as $message)
						<tr>
							<td>{{ $message->id }}</td>
							<td>{{ $message->name }}</td>
							<td>{{ $message->email }}</td>
							<td>{{ $message->created_at->diffForHumans() }}</td>
							<td class="center aligned">
								<a href="{{ route('admin.message.show', $message->id) }}" class="ui tiny positive button">View</a>
							</td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="4" class="center aligned">No message</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
</div>

{{-- <div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li class="active">Message</li>
		</ol>
	</div>
	<div class="col-md-12">
		<h2>Message</h2>
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Email</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($messages as $message)
				<tr>
					<td>{{ $message->id }}</td>
					<td>{{ $message->name }}</td>
					<td>{{ $message->email }}</td>
					<td>
						<a href="{{ route('admin.message.show', $message->id) }}" class="btn btn-default">View</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div> --}}
@endsection

