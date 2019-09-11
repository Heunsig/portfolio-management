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
	<h2 class="ui header">Manage Icon</h2>
	<div class="sixteen wide column">
		<div class="ui grid">
			<div class="eight wide column">
				<h3 class="ui header top attached">Added Icons</h3>
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
							@if(count($icons))
								@foreach($icons as $icon)
									<tr>
										<td>{{ $icon->id }}</td>
										<td>{{ $icon->name }}</td>
										<td class="center aligned">
											<i class="icon {{ $icon->code }}"></i>
										</td>
										<td class="center aligned">
											<a href="{{ route('admin.icons.show', $icon->id) }}" class="ui button tiny positive">View</a>
										</td>
									</tr>
								@endforeach
							@else
								<tr>
									<td colspan="4" class="center aligned catcha c-text-noContent">No icons</td>
								</tr>
							@endif
						</tbody>
					</table>
				</div>
			</div>
			<div class="eight wide column">
				<h3 class="ui header top attached">New icon</h3>
				<div class="ui segment attached">
					{{ Form::open(['route'=>'admin.icons.store', 'method'=>'POST', 'class'=>'ui form', 'id'=>'form']) }}
						<div class="field">
							{{ Form::label('name', 'Name:') }}
							{{ Form::text('name', null) }}
						</div>
						<div class="field">
							{{ Form::label('code', 'Icon Code:')}}
							{{ Form::text('code', null) }}
						</div>
						<div class="field">
							<div class="catcha c-button-box">
								<div class="space"></div>
								<div class="actions">
									{{ Form::submit('Save', ['class'=>'ui button primary', 'id'=>'btnSave']) }}
								</div>
							</div>
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