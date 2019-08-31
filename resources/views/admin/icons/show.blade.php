@extends('admin.main')

@section('title', '- Icon ' . $icon->name)

@section('content')
<div class="ui grid">
	<div class="sixteen wide column">
		<div class="ui grid catcha c-header-main">
			<div class="twelve wide column">
				<h1 class="ui header catcha c-header-title">Icon</h1>
				<div class="ui breadcrumb">
				  <a class="section">Home</a>
				  <div class="divider"> / </div>
				  <a class="section">Icon</a>
				  <div class="divider"> / </div>
				  <div class="section active">View: {{ $icon->id }}</div>
				</div>
			</div>
			<div class="four wide column right aligned">
				<a class="ui primary button" href="{{ route('admin.icon.index') }}">
				  Back to list
				</a>
				<button 
					type="button" 
					class="ui button orange" 
					id="btnEditIcon"
				>
					Edit
				</button>
				{{ Form::open(['route'=>['admin.icon.destroy', $icon->id], 'method'=>'DELETE', 'class'=>'catcha c-alignment-inline', 'id'=>'formToDeleteIcon']) }}
					<button class="ui button red" id="btnDelete">Delete</button>
				{{ Form::close() }}
			</div>
		</div>
	</div>
	<h2 class="ui header">Icon #{{ $icon->id }}'s details</h2>
	<div class="sixteen wide column">
		<div class="ui grid">
			<div class="four wide column">
				<h3 class="ui header top attached">Icon information</h3>
				<div class="ui segment attached">
					<div class="ui grid">
	    			<div class="row">
				    	<div class="column">
				    		<div class="ui tiny header">Name</div>
				    		<p>{{ $icon->name }}</p>
				    	</div>
				    </div>
				    <div class="row">
				    	<div class="column">
				    		<div class="ui tiny header">Icon</div>
				    		<p><i class="ui icon {{ $icon->code }}"></i></p>
				    	</div>
				    </div>
				    <div class="row">
				    	<div class="column">
				    		<div class="ui tiny header">Code</div>
				    		<p>{{ $icon->code }}</p>
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
								<th width="500">icons</th>
							</tr>
						</thead>
						<tbody>
							@if(count($icon->portfolios))
								@foreach($icon->portfolios as $portfolio)
								<tr>
									<td>{{ $portfolio->id }}</td>
									<td><a href="{{ route('admin.portfolio.show', $portfolio->id) }}">{{ $portfolio->name }}</a></td>
									<td>
										@foreach($portfolio->icons as $icon)
											<i class="ui icon {{$icon->code}}"></i>
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
</div> --}}

@component('admin.components.modals.checkingModal')
	@slot('id')
		modalDeleteIcon
	@endslot
	@slot('title')
		Warning
	@endslot
	Do you want to delete this icon?
@endcomponent

<div class="ui tiny modal" id="modalEditIcon">
  <div class="header">Edit Type</div>
  <div class="content">
		{{ Form::model($icon, ['route'=>['admin.icon.update', $icon->id], 'method'=>'PUT', 'class'=>'ui form', 'id'=>'formEditIcon']) }}
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
	$('#btnDelete').on('click', e => {
		e.preventDefault()
		$('#modalDeleteIcon').modal({
			closable: false,
			onApprove: () => {
				$('#modalDeleteIcon > .actions > button').addClass('loading disabled')
				$('#formToDeleteIcon').submit()
				return false
			}
		}).modal('show')
	})

	$('#btnEditIcon').on('click', e => {
		e.preventDefault()
		$('#modalEditIcon').modal({
			closable: false,
			onApprove: () => {
				$('#modalEditIcon > .actions > button').addClass('loading disabled')
				$('#formEditIcon').submit()
				return false
			}
		}).modal('show')
	})
</script>
@endpush