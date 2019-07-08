@extends('admin.main')

@section('title', '- Add Types')

@section('content')

<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li class="active">Type</li>
		</ol>
	</div>
	<div class="col-md-8">
		<h2>Types</h2>
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($types as $type)
				<tr>
					<td>{{ $type->id }}</td>
					<td>{{ $type->name }}</td>
					<td>
						<a href="{{ route('admin.type.show', $type->id) }}" class="btn btn-default">View</a>
						<a href="{{ route('admin.type.edit', $type->id) }}" class="btn btn-default">Edit</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="text-center">
			{!! $types->links(); !!}
 		</div>
	</div>
	<div class="col-md-4">
		<div class="well">
			<h3>Add Type</h3>
			<div>
				{{ Form::open(['route'=>'admin.type.store', 'method'=>'POST']) }}

					{{ Form::label('name', 'Name:') }}
					{{ Form::text('name', null, ['class'=>'form-control']) }}

					{{ Form::label('code', 'Code:') }}
					{{ Form::text('code', null, ['class'=>'form-control']) }}					
					{{ Form::submit('Create New Type', ['class'=>'btn btn-block btn-primary space-margin-top']) }}
				{{  Form::close() }}		
			</div>
		</div>
		
	</div>
</div>
@endsection
