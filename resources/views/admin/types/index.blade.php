@extends('admin.main')

@section('title', '- Add Types')

@section('content')

<div class="ui grid">
	<div class="sixteen wide column">
		<div class="ui grid catcha c-header-main">
			<div class="twelve wide column">
				<h1 class="ui header catcha c-header-title">Type</h1>
				<div class="ui breadcrumb">
				  <a class="section">Home</a>
				  <div class="divider"> / </div>
				  <div class="section active">Type</div>
				</div>
			</div>
			<div class="four wide column right aligned">

			</div>
		</div>
	</div>
	<h2 class="ui header">Manage types</h2>
	<div class="sixteen wide column">
		<div class="ui grid">
			<div class="eight wide column">
				<h3 class="ui header top attached">Type list</h3>
				<div class="ui segment attached">
					<table class="ui very basic celled table">
						<thead>
							<tr>
								<th width="50">#</th>
								<th>Name</th>
								<th width="100"></th>
							</tr>
						</thead>
						<tbody>
							@foreach($types as $type)
							<tr>
								<td>{{ $type->id }}</td>
								<td>{{ $type->name }}</td>
								<td class="center aligned">
									<a href="{{ route('admin.type.show', $type->id) }}" class="ui button tiny positive">View</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<div class="eight wide column">
				<h3 class="ui header top attached">Form adding a type</h3>
				<div class="ui segment attached">
					{{ Form::open(['route'=>'admin.type.store', 'method'=>'POST', 'class'=>'ui form']) }}
						<div class="field">
							{{ Form::label('name', 'Name:') }}
							{{ Form::text('name', null) }}
						</div>
						<div class="field">
							{{ Form::label('code', 'Code:') }}
							{{ Form::text('code', null) }}					
						</div>
						<div class="field">
							{{ Form::submit('Save', ['class'=>'ui button primary']) }}
						</div>
					{{  Form::close() }}
				</div>
			</div>
		</div>
	</div>
</div>


{{-- <div class="row">
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
</div> --}}
@endsection
@push('scripts')
<script>
	// $('.__btnEditType').on('click', e => {
	// 	e.preventDefault()
	// 	var typeId = e.currentTarget.dataset['typeId'] 
	// 	var typeName = e.currentTarget.dataset['typeName']
	// 	var typeCode = e.currentTarget.dataset['typeCode']

	// 	$('#formEditType').attr('action', `/admin/type/${typeId}`)
	// 	$('#formEditType input[name="name"').val(typeName)
	// 	$('#formEditType input[name="code"').val(typeCode)

	// 	$('.ui.tiny.modal.__modalEditType').modal('show')	
	// })
	// $('.ui.tiny.modal.__modalEditType').modal({
	// 	onApprove: () => {
	// 		$('#formToDelete').submit()
 //    }
	// }).modal('show')
</script>
@endpush