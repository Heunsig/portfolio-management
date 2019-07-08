@extends('admin.main')

@section('title','- Message')

@section('content')
<div class="row">
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
</div>
@endsection

