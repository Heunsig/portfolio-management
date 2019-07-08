@extends('admin.main')

@section('title', '- Icon ' . $icon->name)

@section('content')

<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="{{ route('admin.icon.index') }}">Icon</a></li>
			<li class="active">Edit</li>
		</ol>
	</div>
	<div class="col-md-12">
		{{ Form::model($icon, ['route'=>['admin.icon.update', $icon->id], 'method'=>'PUT']) }}
		
		{{ Form::label('name', 'Name:') }}	
		{{ Form::text('name', null, ['class'=>'form-control']) }}

		{{ Form::label('code', 'Icon code:') }}
		{{ Form::text('code', null, ['class'=>'form-control']) }}
		
		{{ Form::submit('Save Changes', ['class'=>'btn btn-success space-margin-top']) }}

		{{ Form::close() }}
	</div>
</div>

@endsection