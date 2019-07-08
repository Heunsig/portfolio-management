@extends('admin.main')

@section('title', '- Support Icons')

@push('stylesheets')
{{ Html::style('assets/admin/css/icon.css') }}
@endpush

@section('content')
<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li class="active">Icon</li>
		</ol>
	</div>
	<div class="col-md-8">
		<h2>Icons</h2>
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Icon</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($icons as $icon)
				<tr>
					<td>{{ $icon->id }}</td>
					<td>{{ $icon->name }}</td>
					<td><i class="icon {{ $icon->code }} custom-icon-style"></i></td>
					<td>
						<a href="{{ route('admin.icon.show', $icon->id) }}" class="btn btn-default">View</a>
						<a href="#" class="btn btn-default">Edit</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="text-center">
			{!! $icons->links(); !!}
 		</div>
	</div>
	<div class="col-md-4">
		<div class="well">
			<h3>Add Type</h3>
			<div>
				{{ Form::open(['route'=>'admin.icon.store', 'method'=>'POST']) }}
					{{ Form::label('name', 'Name:')}}
					{{ Form::text('name', null, ['class'=>'form-control']) }}

					{{ Form::label('code', 'Icon Code:')}}
					{{ Form::text('code', null, ['class'=>'form-control']) }}
					{{ Form::submit('Create New Icon', ['class'=>'btn btn-block btn-primary space-margin-top']) }}
				{{  Form::close() }}		
			</div>
		</div>
		
	</div>
</div>
@endsection