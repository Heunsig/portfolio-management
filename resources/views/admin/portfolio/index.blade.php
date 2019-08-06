@extends('admin.main')

@section('title', '- Portfolio')

@section('content')

<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li class="active">Portfolio</li>
		</ol>
	</div>
	<div class="col-md-8">
		<h2>Portfolio</h2>
	</div>
	<div class="col-md-2 col-md-offset-2">
		<a href="{{ route('admin.portfolio.create') }}" class="btn btn-block btn-primary space-margin-top">Create New Portfolio</a>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<table id="itemListTbl" class="table" data-tbl-type="portfolio">
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
				@foreach($portfolios as $portfolio)
				<tr data-id="{{$portfolio->id}}">
					<td><span class="order_handle glyphicon glyphicon-move"></span></td>
					<td>{{ $portfolio->id }}</td>
					<td>

						@php
							$selected_file = $portfolio->select_frist_file();
						@endphp
						@if(isset($selected_file))
						<div class="list-thumbnail">
							<img src="{{env('AWS_OBJECT_BASEURL') . $selected_file['thumbnail_dir']}}"/>
						</div>
						@else
						<div class="list-thumbnail">
							{{ Html::image('/assets/admin/images/thumbnail_noImage.gif') }}
						</div>
						@endif
					</td>
					<td>{{ $portfolio->name }}</td>
					<td>
						@foreach($portfolio->types as $type)
							<span class="label label-default">{{ $type->name }}</span>
						@endforeach
					</td>
					<td>
						@foreach($portfolio->icons as $icon)
							<i class="icon {{ $icon->code }} custom-icon-style"></i>
						@endforeach
					</td>
					<td>
						<a href="{{ route('admin.portfolio.show', $portfolio->id)}}" class="btn btn-default">View</a>
						<a href="{{ route('admin.portfolio.edit',$portfolio->id) }}" class="btn btn-default">Edit</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="text-center">
			{!! $portfolios->links(); !!}
 		</div>
	</div>
</div>

@endsection

@push('scripts')
{{ Html::script('assets/admin/js/portfolio_index.js') }}
@endpush