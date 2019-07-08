@extends('admin.main')

@section('title', '- Portfolio ')

@section('content')

<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="{{ route('admin.portfolio.index') }}">Portfolio</a></li>
			<li class="active">View</li>
		</ol>
	</div>
	<div class="col-md-12">
		<div class="page-header">
			<h1>{{ $portfolio->name }} <small><a href="{{ $portfolio->link }}" target="_blank">{{ $portfolio->link }}</a></small></h1>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-12">{{ $portfolio->explanation }}</div>
				</div>
				<hr/>
				<div class="row">
					<div class="col-md-12 thumbnail_section">
						@foreach($portfolio->files()->orderBy('order_number','asc')->get() as $file)
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
							@foreach($portfolio->types as $type)
								<span class="label label-default">{{ $type->name }}</span>
							@endforeach
						</p>
					</div>
					<div href="#" class="list-group-item">
						<h4 class="list-group-item-heading">Icons</h4>
						<p class="list-group-item-text">
							@foreach($portfolio->icons as $icon)
								<i class="icon {{$icon->code}}"></i>
							@endforeach
						</p>
					</div>
					<div href="#" class="list-group-item">
						<h4 class="list-group-item-heading">Created At</h4>
						<p class="list-group-item-text">{{ $portfolio->created_at }}</p>
					</div>
					<div href="#" class="list-group-item">
						<h4 class="list-group-item-heading">Updated At</h4>
						<p class="list-group-item-text">{{ $portfolio->updated_at }}</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<a href="{{ route('admin.portfolio.edit', $portfolio->id) }}" class="btn btn-primary btn-block">Edit</a>
					</div>
					<div class="col-md-6">
						{{ Form::open(['route'=>['admin.portfolio.destroy', $portfolio->id], 'method'=>'DELETE']) }}
						<button class="btn btn-danger btn-block">Delete</button>
						{{ Form::close() }}
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<a href="{{ route('admin.portfolio.index') }}" class="btn btn-default btn-block space-margin-top"><< See All of portfolios</a>
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