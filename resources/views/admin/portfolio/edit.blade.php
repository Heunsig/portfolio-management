@extends('admin.main')

@section('title', '- Edit Portfolio')

@push('stylesheets')
{{ Html::style('assets/admin/css/edit_port_temp.css') }}
@endpush

@section('content')
{{ Form::model($portfolio, ['route'=>['admin.portfolio.update', $portfolio->id], 'method'=>'PUT', 'files'=>true, 'class'=>'ui form catcha c-form']) }}
<div class="ui grid">
	<div class="sixteen wide column">
		<div class="ui grid catcha c-header-main">
			<div class="twelve wide column">
				<h1 class="ui header catcha c-header-title">Portfolio</h1>
				<div class="ui breadcrumb">
				  <a class="section">Home</a>
				  <div class="divider"> / </div>
				  <a class="section" href="{{ route('admin.portfolio.index') }}">Portfolio</a>
				  <div class="divider"> / </div>
				  <a class="section" href="{{ route('admin.portfolio.show', $portfolio->id) }}">View portfolio: {{ $portfolio->id }}</a>
				  <div class="divider"> / </div>
				  <div class="section active">Edit</div>
				</div>
			</div>
			<div class="four wide column right aligned">
				<a href="{{ route('admin.portfolio.show', $portfolio->id)}}" class="ui grey button">Back to View Page</a>
			</div>
		</div>
	</div>
	<h2 class="ui header">
    Edit portfolio #{{ $portfolio->id }}
  </h2>
	<div class="sixteen wide column">
		<div class="ui grid">
			<div class="seven wide column">
				<div class="ui grid">
					<div class="row">
						<div class="column">
							<div class="ui header top attached">
								Portfolio information
							</div>
							<div class="ui segment attached">
								<div class="field">
									{{ Form::label('name', 'Name:') }}
									{{ Form::text('name', null) }}
								</div>	
							</div>
						</div>
					</div>
					<div class="row">
						<div class="column">
							<div class="ui header top attached">Links</div>
							<div class="ui segment attached">
								<div class="field" id="linkFields">
									<div class="catcha c-button-box">
										<div class="space"></div>
										<div class="actions">
											<button type="button" id="btnAddLinkField" class="ui mini primary button">Add</button>		
										</div>
									</div>
									@if(count($portfolio->links))
										@foreach($portfolio->links as $index => $link)
											@component('admin.components.linkField', ['index'=>$index, 'link'=>$link])
											@endcomponent
										@endforeach
									@else
										@component('admin.components.linkField')
											@endcomponent
									@endif
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="column">
							<div class="ui header top attached">Categories & Icons</div>
							<div class="ui segment attached">
								<div class="ui grid">
									<div class="eight wide column">
										<div class="field">
											<label>Categories</label>
									    <select multiple="" class="ui dropdown"	id="categories" name="categories[]">
												<option value="">Select Categories</option>
									    	@foreach ($categories as $key => $category)
									    		<option value="{{ $key }}">{{ $category }}</option>
									    	@endforeach
									    </select>
										</div>
									</div>
									<div class="eight wide column">
										<div class="field">
											<label>Icons</label>
									    <select multiple="" class="ui dropdown"	id="icons" name="icons[]">
												<option value="">Select Icons</option>
									    	@foreach ($icons as $key => $icon)
									    		<option value="{{ $key }}">{{ $icon }}</option>
									    	@endforeach
									    </select>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="column">
							<div class="ui header top attached">{{ Form::label('explanation', 'Explanation:') }}</div>
							<div class="ui segment attached">
								<div class="field">
									{{ Form::textarea('explanation', null) }}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="nine wide column">
				<div class="ui grid">
					<div class="row">
						<div class="sixteen wide column">
							<h3 class="ui header top attached">Portfolio image upload</h3>
							<div class="ui segment attached">
								<div class="field">
									{{ Form::label('images[]', 'Images:') }}
									{{ Form::file('images[]', ['multiple'=>''])}}
								</div>
							</div>
						</div>	
					</div>
					<div class="row">
						<div class="sixteen wide column">
							<h3 class="ui header top attached">Uploaded images</h3>
							<div class="ui segment attached">
								@php
									$portfolioImages = $portfolio->files()->orderBy('order_number','asc')->get()
								@endphp	
								@if(count($portfolioImages))
								<div class="ui five doubling cards" id="uploadedImages" data-portfolio-id="{{ $portfolio->id }}">
									@foreach($portfolioImages as $file)
										<div class="ui link card" data-id="{{ $file->id }}">
										  <div class="image">
										    <img src="{{env('AWS_OBJECT_BASEURL') . $file->thumbnail_dir}}" alt="{{ $file->orig_name }}" />
										  </div>
										  <div class="content">
										    <div>{{ $file->orig_name }}</div>
										    <div class="meta">
										      <span class="date">{{ humanFileSize($file->size) }}</span>
										    </div>
										  </div>
										  <div class="extra content">
										  	<button data-id="{{ $file->id }}" type="button" class="ui mini red basic button __btnDelete">Delete</button>	
									    </div>
										</div>
									@endforeach
								</div>
								@else
									@component('admin.components.data', ['tag'=>'div'])
										No upladed images
									@endcomponent
								@endif
							</div>
						</div>
					</div>
					<div class="row">
						<div class="column">
							<div class="catcha c-button-box">
								<div class="space"></div>
								<div class="actions">
									{{ Form::submit('Save', ['class'=>'ui button primary', 'id'=>'btnUpdate']) }}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
{{ Form::close() }}
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
{{ Html::script('assets/admin/js/templates/linkField.js') }}

<script type="text/javascript">
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

	$(".__btnDelete").on('click', e => {
		var input = document.createElement('input')
		input.setAttribute('type', 'hidden')
		input.setAttribute('name', 'images_to_delete[]')
		input.value = e.target.dataset['id']

		$('form').append(input)
		$(e.target).parents('.ui.link.card').remove()
	})

	$('#btnUpdate').on('click', e => {
		e.preventDefault()
		$('#blackout').dimmer({
			closable: false,
			onShow: function () {
				$('form').submit()
			}
		}).dimmer('show')
	})


	$('#categories').dropdown('set selected', {!! json_encode($selected_categories) !!})
	$('#icons').dropdown('set selected', {!! json_encode($selected_icons) !!})
	$('.__linkName').dropdown({
		clearable: true,
		allowAdditions: true
	})

	var uploadedImages = document.querySelector('#uploadedImages')
	if (uploadedImages) {
		var sortable = new Sortable(uploadedImages, {
	    ghostClass: 'dragging',
			draggable: '.ui.link.card',
			onUpdate: function (e) {
				var type = 'portfolio'
				var portfolioId = this.el.dataset['portfolioId']
				var sortedIds = this.toArray()

				$.ajax({
					method: "PUT",
					url: `/admin/relocateImageOrder/${type}/${portfolioId}`,
					dataType: "json",
					data: { "sortedIds[]": sortedIds },
					success: function(data) {
					},
					error: function (req, status, error) {
						// console.error(req.responseText)
					}
				});
			}
		})
	}
</script>
{{-- {{ Html::script('assets/admin/js/edit_port_temp.js') }} --}}
@endpush