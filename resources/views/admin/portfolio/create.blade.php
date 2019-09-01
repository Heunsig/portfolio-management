@extends('admin.main')

@section('title','- Create Portfolio')

@push('stylesheets')
	{{-- {{ Html::style('assets/admin/lib/select2/select2.min.css') }} --}}
@endpush

@section('content')
{{ Form::open(['route'=>'admin.portfolio.store', 'method'=>'POST', 'files'=>true, 'class'=>'ui form catcha c-form']) }}
{{-- {{ Form::open(['route'=>'test', 'method'=>'POST', 'files'=>true, 'class'=>'ui form catcha c-form']) }} --}}
<div class="ui grid">
	<div class="sixteen wide column">
		<div class="ui grid catcha c-header-main">
			<div class="twelve wide column">
				<h1 class="ui header catcha c-header-title">Portfolio</h1>
				<div class="ui breadcrumb">
				  <a class="section">Home</a>
				  <div class="divider"> / </div>
				  <a class="section">Portfolio</a>
				  <div class="divider"> / </div>
				  <div class="section active">New</div>
				</div>
			</div>
			<div class="four wide column right aligned" id="btnSave">
				{{ Form::submit('Save', ['class'=>'ui button primary']) }}
				{{-- {{ Form::submit('Save', ['class'=>'ui button primary']) }} --}}
			</div>
		</div>
	</div>
	<div class="sixteen wide column">
		<div class="ui grid">
			<div class="seven wide column">
				<h3 class="ui header top attached">Portfolio information</h3>
				<div class="ui segment attached">
					<div class="field">
						{{ Form::label('name', 'Name:') }}
						{{ Form::text('name', null) }}
					</div>
					<div class="ui divider"></div>
					<div class="field" id="linkFields">
						<div class="catcha c-form-label-box">
							<label>Links</label>
							<button type="button" id="btnAddLinkField" class="ui mini primary button">Add</button>
						</div>
						@component('admin.components.linkField')
						@endcomponent
					</div>
					<div class="ui divider"></div>
					<div class="field">
						<label>Type</label>
				    <select multiple="" class="ui dropdown"	id="types" name="types[]">
							<option value="">Select Type</option>
				    	@foreach ($types as $key => $type)
				    		<option value="{{ $key }}">{{ $type }}</option>
				    	@endforeach
				    </select>
					</div>
					<div class="ui divider"></div>
					<div class="field">
						<label>Icon</label>
				    <select multiple="" class="ui dropdown"	id="icons" name="icons[]">
							<option value="">Select Icon</option>
				    	@foreach ($icons as $key => $icon)
				    		<option value="{{ $key }}">{{ $icon }}</option>
				    	@endforeach
				    </select>
					</div>
					<div class="ui divider"></div>
					<div class="field">
						{{ Form::label('explanation', 'Explanation:') }}
						{{ Form::textarea('explanation', null) }}
					</div>
				</div>
			</div>
			<div class="nine wide column">
				<h3 class="ui header top attached">Portfolio image upload</h3>
				<div class="ui segment attached">
					<div class="field">
						{{ Form::label('images[]', 'Images:') }}
						{{ Form::file('images[]', ['multiple'=>''])}}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
{{ Form::close() }}
@endsection

@push('scripts')
{{ Html::script('assets/admin/js/templates/linkField.js') }}
<script>
	var linkFieldTemplate = LinkFieldTemplate('#linkFields', '.__linkFields', () => {
	  $('.__linkName').dropdown({
	    allowAdditions: true
	  })
	})

	$("#btnAddLinkField").on('click', e => {
	  e.preventDefault()
	  linkFieldTemplate.add()
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

	$('#types').dropdown()
	$('#icons').dropdown()
	$('.__linkName').dropdown({
	  allowAdditions: true
	})
</script>
@endpush