@extends('admin.main')

@section('title', '- Portfolio ')

@section('content')
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
				  <div class="section active">View: {{ $portfolio->id }}</div>
				</div>
			</div>
			<div class="four wide column right aligned">
				<a class="ui primary button" href="{{ route('admin.portfolio.index') }}">
				  Back to list
				</a>
				<a class="ui orange button" href="{{ route('admin.portfolio.edit', $portfolio->id) }}">
				  Edit
				</a>
				{{ Form::open(['route'=>['admin.portfolio.destroy', $portfolio->id], 'method'=>'DELETE', 'class'=>'catcha c-alignment-inline', 'id'=>'formToDelete']) }}
					<button class="ui red button" id="btnDelete">Delete</button>
				{{ Form::close() }}
			</div>
		</div>
	</div>
	<h2 class="ui header">
    Portfolio #{{ $portfolio->id }}'s details
  </h2>
	<div class="sixteen wide column">
		<div class="ui grid">
			<div class="seven wide column">
				<h3 class="ui header top attached">
			    Portfolio information
			  </h3>
				<div class="ui segment attached">
	    		<div class="ui grid">
	    			<div class="row">
				    	<div class="seven wide column">
				    		<div class="ui tiny header">Name</div>
				    		<p>{{ $portfolio->name }}</p>
				    	</div>
				    	<div class="four wide column">
				    		<div class="ui tiny header">Created at</div>
				    		<p>{{ $portfolio->created_at }}</p>
				    	</div>
							<div class="five wide column">
								<div class="ui tiny header">Updated at</div>
				    		<p>{{ $portfolio->updated_at }}</p>
							</div>
						</div>
						<div class="ui divider"></div>
						<div class="row">
							<div class="eight wide column">
								<div class="ui tiny header">Types</div>
								<p>
									@if(count($portfolio->types))
										@foreach($portfolio->types as $type)
											<div class="ui label grey">{{ $type->name }}</div>
										@endforeach
									@else
										No type
									@endif
								</p>
							</div>
							<div class="eight wide column">
								<div class="ui tiny header">Icons</div>
								<p>
									@if(count($portfolio->icons))
										@foreach($portfolio->icons as $icon)
											<i class="ui icon {{$icon->code}}"></i>
										@endforeach
									@else
										No icon
									@endif
								</p>
							</div>
						</div>
						<div class="ui divider"></div>
						<div class="row">
							<div class="sixteen wide column">
								<div class="ui tiny header">Links</div>
								<div class="ui list large">
									@if(count($portfolio->links))
										@foreach($portfolio->links as $link)
											@component('admin.components.link', ['link'=>$link])
											@endcomponent
									  @endforeach
									@else
										No link
									@endif
								</div>
							</div>
						</div>
						<div class="ui divider"></div>
						<div class="row">
							<div class="sixteen wide column">
								<div class="ui tiny header">Explanation</div>
								<p>
									@if($portfolio->explanation)
										{!! nl2br(e($portfolio->explanation)) !!}
									@else
										No explanation
									@endif
								</p>
							</div>
						</div>
	    		</div>
				</div>
			</div>
			<div class="nine wide column">
				<h3 class="ui header top attached">
			    Uploaded images
			  </h3>
				<div class="ui segment attached">
					<div class="ui grid">
	    			<div class="row">
							<div class="sixteen wide column">
								<div class="ui tiny header">Images</div>
								@if(count($portfolio->files))
									<div class="ui five doubling cards">
										@foreach($portfolio->files()->orderBy('order_number','asc')->get() as $file)
										<div class="card">
										  <div class="image catcha c-cursor-pointer __btnExpandImage" data-img-src="{{env('AWS_OBJECT_BASEURL') . $file->saved_dir}}">
										    <img src="{{env('AWS_OBJECT_BASEURL') . $file->thumbnail_dir}}"/>
										  </div>
										  <div class="content">
										    <div>{{ $file->orig_name }}</div>
										    <div class="meta">
										      <span>{{ humanFileSize($file->size) }}</span>
										    </div>
										  </div>
										</div>
										@endforeach
									</div>
								@else
									<p>No images</p>
								@endif
							</div>
						</div>
	    		</div>
				</div>
			</div>
		</div>
	</div>
</div>


@component('admin.components.modals.checkingModal')
	@slot('id')
		modalDeletePortfolio
	@endslot
	@slot('title')
		Warning
	@endslot
	Do you want to delete this portfolio?
@endcomponent

<div class="ui basic modal __modalExpandImage" style="width: auto;">
  <div class="content"></div>
</div>
@endsection

@push('scripts')
{{-- {{ Html::script('assets/common_lib/masonry/masonry.pkgd.min.js') }}
{{ Html::script('assets/common_lib/imagesloaded.pkgd.js') }} --}}

<script>

$('#btnDelete').on('click', e => {
	e.preventDefault()

	$('#modalDeletePortfolio').modal({
		closable: false,
		onApprove: () => {
			$('#modalDeletePortfolio > .actions > button').addClass('loading disabled')
			$('#formToDelete').submit()
			return false
		}
		// onApprove: () => {
		// 	$('#formToDelete').submit()
  //   }
	}).modal('show')
})

$('.__btnExpandImage').on('click', e => {
	e.preventDefault()
	console.log('e', e)
	$('.ui.modal.__modalExpandImage').modal({
		onShow: () => {
			var src = e.currentTarget.dataset['imgSrc']
			$('.ui.modal.__modalExpandImage > .content').html(`<img src="${src}"/>`)
    }
	}).modal('show')
})
// jQuery
// $('.thumbnail_section').imagesLoaded( function() {
// 	$('.thumbnail_section').masonry({
// 		columnWidth: 200,
// 		itemSelector: '.grid-item'
// 	});
// });

</script>
@endpush