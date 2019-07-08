@extends('admin.main')

@section('title', '- Template')

@section('content')

<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li class="active">Template</li>
		</ol>
	</div>
	<div class="col-md-8">
		<h2>Template</h2>
	</div>
	<div class="col-md-2 col-md-offset-2">
		<a href="{{ route('admin.template.create') }}" class="btn btn-block btn-primary space-margin-top">Create New Template</a>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<table id="itemListTbl" class="table" data-tbl-type="template">
			<thead>
				<tr>
					<th></th>
					<th>#</th>
					<th>Thumbnail</th>
					<th>Name</th>
					<th>Type</th>
					<th>Icon</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($templates as $template)
				<tr data-id="{{$template->id}}">
					<td><span class="order_handle glyphicon glyphicon-move"></span></td>
					<td>{{ $template->id }}</td>
					<td>

						@php
							$selected_file = $template->select_frist_file();
						@endphp
						@if(isset($selected_file))
						<div class="list-thumbnail">
							<img src="{{$selected_file['saved_dir'] . 'thumbnail/'. $selected_file['saved_name']}}"/>
						</div>
						@else
						<div class="list-thumbnail">							{{ Html::image('/assets/admin/images/thumbnail_noImage.gif') }}
						</div>
						@endif
					</td>
					<td>{{ $template->name }}</td>
					<td>
						@foreach($template->types as $type)
							<span class="label label-default">{{ $type->name }}</span>
						@endforeach
					</td>
					<td>
						@foreach($template->icons as $icon)
							<i class="icon {{ $icon->code }} custom-icon-style"></i>
						@endforeach
					</td>
					<td>
						<a href="{{ route('admin.template.show', $template->id)}}" class="btn btn-default">View</a>
						<a href="{{ route('admin.template.edit',$template->id) }}" class="btn btn-default">Edit</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="text-center">
			{!! $templates->links(); !!}
 		</div>
	</div>
</div>

@endsection

@push("scripts")
{{ Html::script('assets/admin/js/template_index.js') }}
@endpush