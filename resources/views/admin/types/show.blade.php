@extends('admin.main')

@section('title', '- Type')

@section('content')

<div class="ui grid">
	<div class="sixteen wide column">
		<div class="ui grid catcha c-header-main">
			<div class="twelve wide column">
				<h1 class="ui header catcha c-header-title">Type</h1>
				<div class="ui breadcrumb">
				  <a class="section">Home</a>
				  <div class="divider"> / </div>
				  <a class="section">Type</a>
				  <div class="divider"> / </div>
				  <div class="section active">View: {{ $type->id }}</div>
				</div>
			</div>
			<div class="four wide column right aligned">
				<a class="ui primary button" href="{{ route('admin.type.index') }}">
				  Back to list
				</a>
				<button
					type="button" 
					class="ui button orange" 
					id="btnEditType"
				>
					Edit
				</button>
				{{ Form::open(['route'=>['admin.type.destroy', $type->id], 'method'=>'DELETE', 'class'=>'catcha c-alignment-inline', 'id'=>'formToDeleteType']) }}
					<button class="ui button red" id="btnDelete">Delete</button>
				{{ Form::close() }}
			</div>
		</div>
	</div>
	<h2 class="ui header">Type #{{ $type->id }}'s details</h2>
	<div class="sixteen wide column">
		<div class="ui grid">
			<div class="four wide column">
				<h3 class="ui header top attached">Type information</h3>
				<div class="ui segment attached">
					<div class="ui grid">
	    			<div class="row">
				    	<div class="column">
				    		<div class="ui tiny header">Name</div>
				    		<p>{{ $type->name }}</p>
				    	</div>
				    </div>
				    <div class="row">
				    	<div class="column">
				    		<div class="ui tiny header">Code</div>
				    		<p>{{ $type->code }}</p>
				    	</div>
				    </div>
				  </div>
				</div>
			</div>
			<div class="twelve wide column">
				<h3 class="ui header top attached">Portfolios</h3>
				<div class="ui segment attached">
					<table class="ui very basic celled table">
						<thead>
							<tr>
								<th width="50">#</th>
								<th>Name</th>
								<th width="500">Types</th>
							</tr>
						</thead>
						<tbody>
							@if(count($type->portfolios))
								@foreach($type->portfolios as $portfolio)
								<tr>
									<td>{{ $portfolio->id }}</td>
									<td><a href="{{ route('admin.portfolio.show', $portfolio->id) }}">{{ $portfolio->name }}</a></td>
									<td>
										@foreach($portfolio->types as $type)
											<span class="ui grey label">{{$type->name}}</span>
										@endforeach
									</td>
								</tr>
								@endforeach
							@else
								<tr>
									<td colspan="3" class="center aligned">No portfolio</td>
								</tr>
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>



{{-- <div class="row">
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
					<button 
						type="button" 
						class="ui button tiny orange __btnEditType" 
					>
						Edit
					</button>
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
</div> --}}

@component('admin.components.modals.checkingModal')
	@slot('id')
		modalDeleteType
	@endslot
	@slot('title')
		Warning
	@endslot
	Do you want to delete this type?
@endcomponent

<div class="ui tiny modal" id="modalEditType">
  <div class="header">Edit Type</div>
  <div class="content">
		{{ Form::model($type, ['route'=>['admin.type.update', $type->id], 'method'=>'PUT', 'class'=>'ui form', 'id'=>'formEditType']) }}
		<div class="field">
			{{ Form::label('name', 'Name:') }}
			{{ Form::text('name', null) }}
		</div>
		<div class="field">
			{{ Form::label('code', 'Code:') }}
			{{ Form::text('code', null) }}
		</div>
		{{ Form::close() }}
  </div>
  <div class="actions">
  	<button type="button" class="ui grey button cancel">Cancel</button>
  	<button type="button" class="ui primary button approve">Save</button>
  </div>
</div>
@endsection
@push('scripts')
<script>
	$('#btnEditType').on('click', e => {
		e.preventDefault()

		$('#modalEditType').modal({
			closable: false,
			onApprove: () => {
				$('#modalEditType > .actions > button').addClass('loading disabled')
				$('#formEditType').submit()
				return false
			}
		}).modal('show')
	})

	$('#btnDelete').on('click', e => {
		e.preventDefault()

		$('#modalDeleteType').modal({
			closable:false,
			onApprove: () => {
				$('#modalDeleteType > .actions > button').addClass('loading disabled')
				$('#formToDeleteType').submit()
			return false
			}
		}).modal('show')
	})
</script>
@endpush