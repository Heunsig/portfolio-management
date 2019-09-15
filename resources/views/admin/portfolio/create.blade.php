@extends('admin.portfolio.layout')

@section('title','- Create Portfolio')

@section('content.breadcrumb')
	<a class="section">Home</a>
  <div class="divider"> / </div>
  <a class="section">Portfolio</a>
  <div class="divider"> / </div>
  <div class="section active">New</div>
@endsection

@section('content.topButtons')
@endsection

@section('content.content')
{{ Form::open(['route'=>'admin.portfolios.store', 'method'=>'POST', 'files'=>true, 'class'=>'ui form catcha c-form']) }}
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
					<label>Category</label>
			    <select multiple="" class="ui dropdown"	id="categories" name="categories[]">
						<option value="">Select Category</option>
			    	@foreach ($categories as $key => $category)
			    		<option value="{{ $key }}">{{ $category }}</option>
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
					{{ Form::file('images[]', ['multiple'=>''])}}
				</div>
			</div>
			<div class="catcha c-button-box">
				<div class="space"></div>
				<div class="actions">
					{{ Form::submit('Save', ['class'=>'ui button primary']) }}
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
	  	clearable: true,
	    allowAdditions: true
	  })
	})

	$("#btnAddLinkField").on('click', e => {
	  e.preventDefault()
	  linkFieldTemplate.add()
	})

	$('#btnSave').on('click', e => {
		e.preventDefault()
		$('#blackout').dimmer({
			closable: false,
			onShow: function () {
				$('form').submit()
			}
		}).dimmer('show')
	})

	$('#categories').dropdown()
	$('#icons').dropdown()
	$('.__linkName').dropdown({
		clearable: true,
	  allowAdditions: true
	})
</script>
@endpush