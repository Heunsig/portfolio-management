@extends('admin.main')

@section('title', '- Icon ' . $icon->name)

@section('content')

<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="{{ route('admin.icon.index') }}">Icon</a></li>
			<li class="active">View</li>
		</ol>
	</div>
	<div class="col-md-12">
		<div class="page-header">
			<div class="row">
				<div class="col-md-8">
					<h1>Icon : {{ $icon->name }} <i class="icon {{$icon->code}} custom-icon-style"></i></h1>	
				</div>
				<div class="col-md-2">
					<a href="{{ route('admin.icon.edit', $icon->id) }}" class="btn btn-primary btn-block">Edit</a>
				</div>
				<div class="col-md-2">
					{{ Form::open(['route'=>['admin.icon.destroy', $icon->id], 'method'=>'DELETE']) }}
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
						<th>Icons</th>
					</tr>
				</thead>
				<tbody>
					@foreach($icon->portfolios as $portfolio)
					<tr>
						<td>{{ $portfolio->id }}</td>
						<td><a href="{{ route('admin.portfolio.show', $portfolio->id) }}">{{ $portfolio->name }}</a></td>
						<td>
							@foreach($portfolio->icons as $icon)
								<i class="icon {{$icon->code}} custom-icon-style"></i>
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
						<th>Icons</th>
					</tr>
				</thead>
				<tbody>
					@foreach($icon->templates as $template)
					<tr>
						<td>{{ $template->id }}</td>
						<td><a href="{{ route('admin.template.show', $template->id) }}">{{ $template->name }}</a></td>
						<td>
							@foreach($template->icons as $icon)
								<i class="icon {{$icon->code}} custom-icon-style"></i>
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