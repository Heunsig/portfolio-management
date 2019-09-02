@extends('admin.main')

@section('title', '- Category')

@section('content')

<div class="ui grid">
	<div class="sixteen wide column">
		<div class="ui grid catcha c-header-main">
			<div class="twelve wide column">
				<h1 class="ui header catcha c-header-title">Category</h1>
				<div class="ui breadcrumb">
				  <a class="section">Home</a>
				  <div class="divider"> / </div>
				  <a class="section">Category</a>
				  <div class="divider"> / </div>
				  <div class="section active">View: {{ $category->id }}</div>
				</div>
			</div>
			<div class="four wide column right aligned">
				<a class="ui primary button" href="{{ route('admin.category.index') }}">
				  Back to list
				</a>
				<button
					type="button" 
					class="ui button orange" 
					id="btnEditCategory"
				>
					Edit
				</button>
				{{ Form::open(['route'=>['admin.category.destroy', $category->id], 'method'=>'DELETE', 'class'=>'catcha c-alignment-inline', 'id'=>'formToDeleteCategory']) }}
					<button class="ui button red" id="btnDelete">Delete</button>
				{{ Form::close() }}
			</div>
		</div>
	</div>
	<h2 class="ui header">Category #{{ $category->id }}'s details</h2>
	<div class="sixteen wide column">
		<div class="ui grid">
			<div class="four wide column">
				<h3 class="ui header top attached">Category information</h3>
				<div class="ui segment attached">
					<div class="ui grid">
	    			<div class="row">
				    	<div class="column">
				    		<div class="ui tiny header">Name</div>
				    		<p>{{ $category->name }}</p>
				    	</div>
				    </div>
				    <div class="row">
				    	<div class="column">
				    		<div class="ui tiny header">Code</div>
				    		<p>{{ $category->code }}</p>
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
								<th width="500">Categories</th>
							</tr>
						</thead>
						<tbody>
							@if(count($category->portfolios))
								@foreach($category->portfolios as $portfolio)
								<tr>
									<td>{{ $portfolio->id }}</td>
									<td><a href="{{ route('admin.portfolio.show', $portfolio->id) }}">{{ $portfolio->name }}</a></td>
									<td>
										@foreach($portfolio->categories as $category)
											<span class="ui grey label">{{$category->name}}</span>
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

@component('admin.components.modals.checkingModal')
	@slot('id')
		modalDeleteCategory
	@endslot
	@slot('title')
		Warning
	@endslot
	Do you want to delete this category?
@endcomponent

<div class="ui tiny modal" id="modalEditCategory">
  <div class="header">Edit Category</div>
  <div class="content">
		{{ Form::model($category, ['route'=>['admin.category.update', $category->id], 'method'=>'PUT', 'class'=>'ui form', 'id'=>'formEditCategory']) }}
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
	$('#btnEditCategory').on('click', e => {
		e.preventDefault()

		$('#modalEditCategory').modal({
			closable: false,
			onApprove: () => {
				$('#modalEditCategory > .actions > button').addClass('loading disabled')
				$('#formEditCategory').submit()
				return false
			}
		}).modal('show')
	})

	$('#btnDelete').on('click', e => {
		e.preventDefault()

		$('#modalDeleteCategory').modal({
			closable:false,
			onApprove: () => {
				$('#modalDeleteCategory > .actions > button').addClass('loading disabled')
				$('#formToDeleteCategory').submit()
			return false
			}
		}).modal('show')
	})
</script>
@endpush