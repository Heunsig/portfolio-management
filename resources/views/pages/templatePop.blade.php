<div class="wrap_portfolio">
	<div class="box_explain">
		<div class="product_title">{{ $template->name }}</div>
		<div class="product_link"><a href="{{ $template->link }}" target="_blank">{{ $template->link }}</a></div>
		<div class="type">
			<div class="icons">
				@foreach($template->icons as $icon)
					<i class="icon {{$icon->code}}"></i>
				@endforeach
			</div>
		</div>
		<div class="product_explain">
			{{ $template->explanation }}
		</div>
	</div>
	<div class="box_images">
		<div class="box_message">사진을 클릭하시면 더 큰 사진으로 볼 수 있습니다.</div>
		<ul class="portfolio_imgs">
			@foreach($template->files()->orderBy('order_number','asc')->get() as $file)
			<li class="img-item"><a href="{{$file->saved_dir}}{{$file->saved_name}}" data-fancybox="detail" data-caption=""><img src="{{$file->saved_dir}}thumbnail/{{$file->saved_name}}" alt=""/></a></li>
			@endforeach
		</ul>
	</div>
</div>
