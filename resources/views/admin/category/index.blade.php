@extends('admin.category.layout')

@section('title', '- Add Categories')

@section('content.breadcrumb')
	<a class="section">Home</a>
  <div class="divider"> / </div>
  <div class="section active">Category</div>
@endsection

@section('content.content')
	<h2 class="ui header">Manage Category</h2>
	<div class="ui grid">
		<div class="eight wide column">
			<h3 class="ui header top attached">Added Categories</h3>
			<div class="ui segment attached">
				<table class="ui very basic celled table">
					<thead>
						<tr>
							<th width="50">#</th>
							<th>Name</th>
							<th>Code</th>
							<th width="100"></th>
						</tr>
					</thead>
					<tbody>
						@if(count($categories))
							@foreach($categories as $category)
							<tr>
								<td>{{ $category->id }}</td>
								<td>{{ $category->name }}</td>
								<td>{{ $category->code }}</td>
								<td class="center aligned">
									<a href="{{ route('admin.categories.show', $category->id) }}" class="ui button tiny positive">View</a>
								</td>
							</tr>
							@endforeach
						@else
							<tr>
								<td colspan="3" class="center aligned catcha c-text-noContent">No categories</td>
							</tr>
						@endif
					</tbody>
				</table>
			</div>
		</div>
		<div class="eight wide column">
			<h3 class="ui header top attached">New category</h3>
			<div class="ui segment attached">
				{{ Form::open(['route'=>'admin.categories.store', 'method'=>'POST', 'class'=>'ui form', 'id'=>'form']) }}
					<div class="field">
						{{ Form::label('name', 'Name:') }}
						{{ Form::text('name', null, ['id'=>'inputName']) }}
					</div>
					<div class="field">
						{{ Form::label('code', 'Code:') }}
						{{ Form::text('code', null, ['id'=>'inputCode']) }}					
					</div>
					<div class="field">
						<div class="catcha c-button-box">
							<div class="space"></div>
							<div class="action">
								{{ Form::submit('Save', ['class'=>'ui button primary', 'id'=>'btnSave']) }}
							</div>
						</div>
					</div>
				{{  Form::close() }}
			</div>
		</div>
	</div>
@endsection

@push('scripts')
{{ Html::script('assets/admin/js/slugify.js') }}
<script>
	////////////////////////////////////////////////
	// Automatically slugify name value for code. //
	////////////////////////////////////////////////
	$('#inputName').on('input propertychange', e => {
		e.preventDefault()

		var value = $(e.target).val()
		$('#inputCode').val(slugify(value))
	})


	$('#btnSave').on('click', e => {
		e.preventDefault()
		$('.ui.page.dimmer').dimmer({
			closable: false,
			onShow: function () {
				$('form').submit()
			}
		}).dimmer('show')
	})
</script>
@endpush