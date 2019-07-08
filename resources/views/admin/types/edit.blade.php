@extends('admin.main')

@section('title', '- Type '. $type->name)

@section('content')

<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="{{ route('admin.type.index') }}">Type</a></li>
			<li class="active">Edit</li>
		</ol>
	</div>
	<div class="col-md-12">
		{{ Form::model($type, ['route'=>['admin.type.update', $type->id],'method'=>'PUT']) }}
		
		{{ Form::label('name', 'Name:') }}
		{{ Form::text('name', null, ['class'=>'form-control']) }}

		{{ Form::label('code', 'Code:') }}
		{{ Form::text('code', null, ['class'=>'form-control']) }}
		
		{{ Form::submit('Save Changes', ['class'=>'btn btn-success  space-margin-top']) }}

		{{ Form::close() }}
	</div>
</div>

@endsection

