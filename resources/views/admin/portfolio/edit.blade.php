@extends('admin.main')

@section('title', '- Edit Portfolio')

@push('stylesheets')
{{ Html::style('assets/admin/css/edit_port_temp.css') }}
@endpush

@section('content')
{{ Form::model($portfolio, ['route'=>['admin.portfolio.update', $portfolio->id], 'method'=>'PUT', 'files'=>true, 'class'=>'ui form']) }}
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
				  <a class="section" href="{{ route('admin.portfolio.show', $portfolio->id) }}">View: 16</a>
				  <div class="divider"> / </div>
				  <div class="section active">Edit</div>
				</div>
			</div>
			<div class="four wide column right aligned">
				<a href="{{ route('admin.portfolio.show', $portfolio->id)}}" class="ui button positive grey">View</a>
				{{ Form::submit('Update', ['class'=>'ui button primary', 'id'=>'btnUpdate']) }}
			</div>
		</div>
	</div>
	<h2 class="ui header">
    Edit portfolio #{{ $portfolio->id }}
  </h2>
	<div class="sixteen wide column">
		<div class="ui grid">
			<div class="seven wide column">
				<h3 class="ui header top attached">Portfolio information</h3>
				<div class="ui segment attached">
					<div class="field">
						{{ Form::label('name', 'Name:') }}
						{{ Form::text('name', null) }}
					</div>
					
					<div class="field">
						{{ Form::label('link', 'Link:') }}
						{{ Form::text('link', null) }}
					</div>
						
					<div class="field">
						<label>Type</label>
				    <select multiple="" class="ui dropdown type"	id="types[]" name="types[]">
							<option value="">Select Type</option>
				    	@foreach ($types as $key => $type)
				    		<option value="{{ $key }}">{{ $type }}</option>
				    	@endforeach
				    </select>
					</div>

					<div class="field">
						<label>Icon</label>
				    <select multiple="" class="ui dropdown icon"	id="icons[]" name="icons[]">
							<option value="">Select Icon</option>
				    	@foreach ($icons as $key => $icon)
				    		<option value="{{ $key }}">{{ $icon }}</option>
				    	@endforeach
				    </select>
					</div>

					<div class="field">
						{{ Form::label('explanation', 'Explanation:') }}
						{{ Form::textarea('explanation', null) }}
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
								<div class="ui five doubling cards" id="uploadedImages" data-portfolio-id="{{ $portfolio->id }}">
								@foreach($portfolio->files()->orderBy('order_number','asc')->get() as $file)
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
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
{{ Form::close() }}
{{-- <div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="{{ route('admin.portfolio.index') }}">Portfolio</a></li>
			<li class="active">Edit</li>
		</ol>
	</div>
	<div class="col-md-12">	
		{{ Form::model($portfolio, ['route'=>['admin.portfolio.update', $portfolio->id], 'method'=>'PUT', 'files'=>true]) }}
		
		{{ Form::label('name', 'Name:') }}
		{{ Form::text('name', null, ['class'=>'form-control']) }}
		
		{{ Form::label('link', 'Link:', ['class'=>'space-margin-top']) }}
		{{ Form::text('link', null, ['class'=>'form-control']) }}

		{{ Form::label('types[]', 'Type:',['class'=>'space-margin-top']) }}
		{{ Form::select('types[]', $types, null, ['class'=>'form-control select-form-multiple types', 'multiple'=>'']) }}

		{{ Form::label('icons[]', 'Support:',['class'=>'space-margin-top']) }}
		{{ Form::select('icons[]', $icons, null, ['class'=>'form-control select-form-multiple icons', 'multiple'=>'']) }}

		{{ Form::label('explanation', 'Explanation:', ['class'=>'space-margin-top']) }}
		{{ Form::textarea('explanation', null, ['class'=>'form-control']) }}
		
		<ul id="updatedImagesBox" class="list-group space-margin-top" data-item-type="portfolio" data-item-id="{{$portfolio->id}}">
			@foreach($portfolio->files()->orderBy('order_number','asc')->get() as $file)
				<li class="list-group-item" data-id="{{$file->id}}">
					<span type="button" style="cursor:move;" class="order_handle glyphicon glyphicon-move"></span>
					<a href="#">
						<img src="{{env('AWS_OBJECT_BASEURL') . $file->thumbnail_dir}}" alt="{{ $file->orig_name }}">
					</a>
					<span class="image_name">{{ $file->orig_name }}</span>

					<button type="button" data-id="{{ $file->id }}" class="btn btn-danger btn-xs btn-delete-image">Delete</button>
				</li>
			@endforeach
		</ul>

		{{ Form::label('images[]', 'Images:', ['class'=>'space-margin-top']) }}
		{{ Form::file('images[]', ['multiple'=>''])}}
		                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
		{{ Form::submit('Save', ['class'=>'btn btn-block btn-success space-margin-top']) }}
	
		{{ Form::close() }}
		
	</div>
</div> --}}
{{-- {{ print_r($types) }}
{{ print_r($types) }} --}}
@endsection


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script type="text/javascript">
	$('.ui.dropdown.type').dropdown('set selected', {!! json_encode($selected_types) !!})
	$('.ui.dropdown.icon').dropdown('set selected', {!! json_encode($selected_icons) !!})

	var sortable = new Sortable(document.querySelector('#uploadedImages'), {
    ghostClass: 'dragging',
		draggable: '.ui.link.card',
		onUpdate: function (e) {
			var type = 'portfolio'
			var portfolioId = this.el.dataset['portfolioId']
			var sortedIds = this.toArray()

			$.ajax({
				method: "PUT",
				url: `/relocateImageOrder/${type}/${portfolioId}`,
				dataType: "json",
				data: { "sortedIds[]": sortedIds },
				success: function(data) {
					console.log(data);
				},
				error: function (req, status, error) {
					console.error(req.responseText)
				}
			});
		}
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
		$('.ui.page.dimmer').dimmer({
			closable: false,
			onShow: function () {
				$('form').submit()
			}
		}).dimmer('show')
	})
</script>
{{-- {{ Html::script('assets/admin/js/edit_port_temp.js') }} --}}
@endpush