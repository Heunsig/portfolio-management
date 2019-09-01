@extends('admin.main')

@section('title', '- Support Icons')

@section('content')
<div class="ui grid">
	<div class="sixteen wide column">
		<div class="ui grid catcha c-header-main">
			<div class="twelve wide column">
				<h1 class="ui header catcha c-header-title">Icon</h1>
				<div class="ui breadcrumb">
				  <a class="section">Home</a>
				  <div class="divider"> / </div>
				  <div class="section active">Icon</div>
				</div>
			</div>
			<div class="four wide column right aligned">

			</div>
		</div>
	</div>
	<h2 class="ui header">Manage icons</h2>
	<div class="sixteen wide column">
		<div class="ui grid">
			<div class="eight wide column">
				<h3 class="ui header top attached">Icon list</h3>
				<div class="ui segment attached">
					<table class="ui very basic celled table">
						<thead>
							<tr>
								<th width="50">#</th>
								<th>Name</th>
								<th width="60" class="center aligned">Icon</th>
								<th width="100"></th>
							</tr>
						</thead>
						<tbody>
							@foreach($icons as $icon)
							<tr>
								<td>{{ $icon->id }}</td>
								<td>{{ $icon->name }}</td>
								<td class="center aligned">
									<i class="icon {{ $icon->code }}"></i>
								</td>
								<td class="center aligned">
									<a href="{{ route('admin.icon.show', $icon->id) }}" class="ui button tiny positive">View</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<div class="eight wide column">
				<h3 class="ui header top attached">Form adding a icon</h3>
				<div class="ui segment attached">
					{{ Form::open(['route'=>'admin.icon.store', 'method'=>'POST', 'class'=>'ui form', 'id'=>'form']) }}
						<div class="field">
							{{ Form::label('name', 'Name:') }}
							{{ Form::text('name', null) }}
						</div>
						<div class="field">
							{{ Form::label('code', 'Icon Code:')}}
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

{{-- <div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li class="active">Icon</li>
		</ol>
	</div>
	<div class="col-md-8">
		<h2>Icons</h2>
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Icon</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($icons as $icon)
				<tr>
					<td>{{ $icon->id }}</td>
					<td>{{ $icon->name }}</td>
					<td><i class="icon {{ $icon->code }}"></i></td>
					<td>
						<a href="{{ route('admin.icon.show', $icon->id) }}" class="btn btn-default">View</a>
						<a href="#" class="btn btn-default">Edit</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="text-center">
			{!! $icons->links(); !!}
 		</div>
	</div>
	<div class="col-md-4">
		<div class="well">
			<h3>Add Type</h3>
			<div>
				{{ Form::open(['route'=>'admin.icon.store', 'method'=>'POST']) }}
					{{ Form::label('name', 'Name:')}}
					{{ Form::text('name', null, ['class'=>'form-control']) }}

					{{ Form::label('code', 'Icon Code:')}}
					{{ Form::text('code', null, ['class'=>'form-control']) }}
					{{ Form::submit('Create New Icon', ['class'=>'btn btn-block btn-primary space-margin-top']) }}
				{{  Form::close() }}		
			</div>
		</div>
		
	</div>
</div> --}}
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