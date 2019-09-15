@extends('admin.message.layout')

@section('title','- Message')

@section('content.breadcrumb')
	<a class="section">Home</a>
  <div class="divider"> / </div>
  <div class="section active">Message</div>
@endsection

@section('content.content')

	<h2>Message List</h2>
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
							<a href="{{ route('admin.messages.show', $message->id) }}" class="ui tiny positive button">View</a>
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

@endsection

