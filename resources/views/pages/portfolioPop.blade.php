<div class="wrap_portfolio">
	<div class="box_explain">
		<div class="product_title">{{ $portfolio->name }}</div>
		<div class="product_link"><a href="{{ route('transfer') }}?url={{urlencode($portfolio->link)}}" target="_blank">{{ $portfolio->link }}</a></div>
		{{-- <div class="product_link"><a href="{{urlencode($portfolio->link)}}" target="_blank">{{ $portfolio->link }}</a></div> --}}
		<div class="type">
			<div class="icons">
				@foreach($portfolio->icons as $icon)
					<i class="icon {{$icon->code}}"></i>
				@endforeach
			</div>
		</div>
		<div class="product_explain">
			{{ $portfolio->explanation }}
		</div>
	</div>
	<div class="box_images">
		<div class="box_message">If you click the pictures, you can see bigger.</div>
		<ul class="portfolio_imgs">
			@foreach($portfolio->files()->orderBy('order_number','asc')->get() as $file)
			<li class="img-item"><a href="{{$file->saved_dir}}{{$file->saved_name}}" data-fancybox="detail" data-caption=""><img src="{{$file->saved_dir}}thumbnail/{{$file->saved_name}}" alt=""/></a></li>
			@endforeach
		</ul>
	</div>
</div>