@extends('admin.main')

@section('title', '- Edit Template')

@push('stylesheets')
{{ Html::style('assets/admin/lib/select2/select2.min.css') }}
{{ Html::style('assets/admin/css/edit_port_temp.css') }}
@endpush

@section('content')
<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="{{ route('admin.template.index') }}">Template</a></li>
			<li class="active">Edit</li>
		</ol>
	</div>
	<div class="col-md-12">	
		{{ Form::model($template, ['route'=>['admin.template.update', $template->id], 'method'=>'PUT', 'files'=>true]) }}
		
		{{ Form::label('name', 'Name:') }}
		{{ Form::text('name', null, ['class'=>'form-control']) }}
		
		{{ Form::label('link', 'Link:', ['class'=>'space-margin-top']) }}
		{{ Form::text('link', null, ['class'=>'form-control']) }}

		{{ Form::label('categories[]', 'Category:',['class'=>'space-margin-top']) }}
		{{ Form::select('categories[]', $categories, null, ['class'=>'form-control select-form-multiple categories', 'multiple'=>'']) }}

		{{ Form::label('icons[]', 'Support:',['class'=>'space-margin-top']) }}
		{{ Form::select('icons[]', $icons, null, ['class'=>'form-control select-form-multiple icons', 'multiple'=>'']) }}

		{{ Form::label('explanation', 'Explanation:', ['class'=>'space-margin-top']) }}
		{{ Form::textarea('explanation', null, ['class'=>'form-control']) }}
		
		<ul id="updatedImagesBox" class="list-group space-margin-top" data-item-type="template" data-item-id="{{$template->id}}">
			@foreach($template->files()->orderBy('order_number','asc')->get() as $file)
				<li class="list-group-item" data-id="{{$file->id}}">
					<span type="button" style="cursor:move;" class="order_handle glyphicon glyphicon-move"></span>
					<a href="#">
						<img src="{{$file->saved_dir.'thumbnail/'.$file->saved_name}}" alt="{{ $file->orig_name }}">
					</a>
					<span class="image_name">{{ $file->saved_name }}</span>
					<button type="button" data-id="{{ $file->id }}" class="btn btn-danger btn-xs btn-delete-image">Delete</button>
				</li>
			@endforeach
		</ul>

		{{ Form::label('images[]', 'Images:', ['class'=>'space-margin-top']) }}
		{{ Form::file('images[]', ['multiple'=>''])}}
		                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
		{{ Form::submit('Save', ['class'=>'btn btn-block btn-success space-margin-top']) }}
	
		{{ Form::close() }}
		
	</div>
</div>
@endsection


@push('scripts')
{{ Html::script('assets/admin/lib/select2/select2.min.js') }}
<script type="text/javascript">
	$(".select-form-multiple").select2();
	$(".select-form-multiple.categories").select2().val({{ json_encode($had_categories) }}).trigger('change');
	$(".select-form-multiple.icons").select2().val({{ json_encode($had_icons) }}).trigger('change');
</script>
{{ Html::script('assets/admin/js/edit_port_temp.js') }}
@endpush