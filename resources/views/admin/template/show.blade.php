@extends('admin.main')

@section('title', '- Template ')

@section('content')

<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="{{ route('admin.template.index') }}">Template</a></li>
			<li class="active">View</li>
		</ol>
	</div>
	<div class="col-md-12">
		<div class="page-header">
			<h1>{{ $template->name }} <small><a href="{{ $template->link }}" target="_blank">{{ $template->link }}</a></small></h1>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-12">{{ $template->explanation }}</div>
				</div>
				<hr/>
				<div class="row">
					<div class="col-md-12 thumbnail_section">
						@foreach($template->files()->orderBy('order_number','asc')->get() as $file)
						<div class="col-xs-6 col-md-3 grid-item">
							<a href="#" class="thumbnail">
								<img src="{{$file->saved_dir.'thumbnail/'.$file->saved_name}}"/>
							</a>
						</div>
						@endforeach
					</div>
				</div>
				
			</div>	
			<div class="col-md-4">
				<div class="list-group">
					<div href="#" class="list-group-item">
						<h4 class="list-group-item-heading">Type</h4>
						<p class="list-group-item-text">
							@foreach($template->types as $type)
								<span class="label label-default">{{ $type->name }}</span>
							@endforeach
						</p>
					</div>
					<div href="#" class="list-group-item">
						<h4 class="list-group-item-heading">Icons</h4>
						<p class="list-group-item-text">
							@foreach($template->icons as $icon)
								<i class="icon {{$icon->code}}"></i>
							@endforeach
						</p>
					</div>
					<div href="#" class="list-group-item">
						<h4 class="list-group-item-heading">Created At</h4>
						<p class="list-group-item-text">{{ $template->created_at }}</p>
					</div>
					<div href="#" class="list-group-item">
						<h4 class="list-group-item-heading">Updated At</h4>
						<p class="list-group-item-text">{{ $template->updated_at }}</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<a href="{{ route('admin.template.edit', $template->id) }}" class="btn btn-primary btn-block">Edit</a>
					</div>
					<div class="col-md-6">
						{{ Form::open(['route'=>['admin.template.destroy', $template->id], 'method'=>'DELETE']) }}
						<button class="btn btn-danger btn-block">Delete</button>
						{{ Form::close() }}
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<a href="{{ route('admin.template.index') }}" class="btn btn-default btn-block space-margin-top"><< See All of templates</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
{{ Html::script('assets/common_lib/masonry/masonry.pkgd.min.js') }}
{{ Html::script('assets/common_lib/imagesloaded.pkgd.js') }}

<script>
// jQuery
$('.thumbnail_section').imagesLoaded( function() {
	$('.thumbnail_section').masonry({
		columnWidth: 200,
		itemSelector: '.grid-item'
	});
});

</script>
@endpush