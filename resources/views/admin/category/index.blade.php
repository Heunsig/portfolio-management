@extends('admin.main')

@section('title', '- Add Categories')

@section('content')

<div class="ui grid">
	<div class="sixteen wide column">
		<div class="ui grid catcha c-header-main">
			<div class="twelve wide column">
				<h1 class="ui header catcha c-header-title">Category</h1>
				<div class="ui breadcrumb">
				  <a class="section">Home</a>
				  <div class="divider"> / </div>
				  <div class="section active">Category</div>
				</div>
			</div>
			<div class="four wide column right aligned">

			</div>
		</div>
	</div>
	<h2 class="ui header">Manage categories</h2>
	<div class="sixteen wide column">
		<div class="ui grid">
			<div class="eight wide column">
				<h3 class="ui header top attached">Category list</h3>
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
							@foreach($categories as $category)
							<tr>
								<td>{{ $category->id }}</td>
								<td>{{ $category->name }}</td>
								<td class="center aligned">
									<a href="{{ route('admin.category.show', $category->id) }}" class="ui button tiny positive">View</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<div class="eight wide column">
				<h3 class="ui header top attached">Form adding a category</h3>
				<div class="ui segment attached">
					{{ Form::open(['route'=>'admin.category.store', 'method'=>'POST', 'class'=>'ui form', 'id'=>'form']) }}
						<div class="field">
							{{ Form::label('name', 'Name:') }}
							{{ Form::text('name', null) }}
						</div>
						<div class="field">
							{{ Form::label('code', 'Code:') }}
							{{ Form::text('code', null) }}					
						</div>
						<div class="field">
							{{ Form::submit('Save', ['class'=>'ui button primary', 'id'=>'btnSave']) }}
						</div>
					{{  Form::close() }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script>

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