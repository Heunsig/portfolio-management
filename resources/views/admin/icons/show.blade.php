@extends('admin.icons.layout')

@section('title', '- Icon ' . $icon->name)

@section('content.breadcrumb')
	<a class="section">Home</a>
  <div class="divider"> / </div>
  <a class="section">Icon</a>
  <div class="divider"> / </div>
  <div class="section active">View icon: {{ $icon->id }}</div>
@endsection

@section('content.topButtons')
	<a class="ui grey button" href="{{ route('admin.icons.index') }}">Back to list</a>
	<button 
		type="button" 
		class="ui button orange" 
		id="btnEditIcon"
	>
		Edit
	</button>
	{{ Form::open(['route'=>['admin.icons.destroy', $icon->id], 'method'=>'DELETE', 'class'=>'catcha c-alignment-inline', 'id'=>'formToDeleteIcon']) }}
		<button class="ui button red" id="btnDelete">Delete</button>
	{{ Form::close() }}
@endsection

@section('content.content')
	<h2 class="ui header">View Icon</h2>
	<div class="ui grid">
		<div class="four wide column">
			<h3 class="ui header top attached">Icon ID #{{ $icon->id }}'s information</h3>
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
			    		<div class="ui tiny header">Icon code</div>
			    		<p>{{ $icon->code }}</p>
			    	</div>
			    </div>
			    <div class="row">
			    	<div class="column">
			    		<div class="ui tiny header">Icon</div>
			    		<p><i class="ui icon {{ $icon->code }}"></i></p>
			    	</div>
			    </div>
			  </div>
			</div>
		</div>
		<div class="twelve wide column">
			<h3 class="ui header top attached">Portfolios having this icon</h3>
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
								<td colspan="3" class="center aligned catcha c-text-noContent">No portfolios</td>
							</tr>
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
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
  <div class="header">Edit Icon</div>
  <div class="content">
		{{ Form::model($icon, ['route'=>['admin.icons.update', $icon->id], 'method'=>'PUT', 'class'=>'ui form', 'id'=>'formEditIcon']) }}
		<div class="field">
			{{ Form::label('name', 'Name:') }}
			{{ Form::text('name', null) }}
		</div>
		<div class="field">
			{{ Form::label('code', 'Icon code:') }}
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