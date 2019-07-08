@extends('admin.main')

@section('title', '- Type')

@section('content')

<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="{{ route('admin.type.index') }}">Type</a></li>
			<li class="active">View</li>
		</ol>
	</div>
	<div class="col-md-12">
		<div class="page-header">
			<div class="row">
				<div class="col-md-8">
					<h1>Type : {{ $type->name }} <small>{{ $type->code }}</small></h1>	
				</div>
				<div class="col-md-2">
					<a href="{{ route('admin.type.edit', $type->id) }}" class="btn btn-primary btn-block">Edit</a>
				</div>
				<div class="col-md-2">
					{{ Form::open(['route'=>['admin.type.destroy', $type->id], 'method'=>'DELETE']) }}
					<button class="btn btn-danger btn-block">Delete</button>
					{{ Form::close() }}
				</div>
			</div>
		</div>
		<div>
			<div class="row">
				<div class="col-md-12">
					<h2>Portfolios</h2>	
				</div>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Types</th>
					</tr>
				</thead>
				<tbody>
					@foreach($type->portfolios as $portfolio)
					<tr>
						<td>{{ $portfolio->id }}</td>
						<td><a href="{{ route('admin.portfolio.show', $portfolio->id) }}">{{ $portfolio->name }}</a></td>
						<td>
							@foreach($portfolio->types as $type)
								<span class="label label-default">{{$type->name}}</span>
							@endforeach
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<div class="row">
				<div class="col-md-12">
					<h2>Templates</h2>	
				</div>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Types</th>
					</tr>
				</thead>
				<tbody>
					@foreach($type->templates as $template)
					<tr>
						<td>{{ $template->id }}</td>
						<td><a href="{{ route('admin.template.show', $template->id) }}">{{ $template->name }}</a></td>
						<td>
							@foreach($template->types as $type)
								<span class="label label-default">{{$type->name}}</span>
							@endforeach
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection