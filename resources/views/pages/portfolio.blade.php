@extends('main')

@section('title', '- Portfolio')

@push('stylesheets')
{{ Html::style('/assets/common_lib/fancybox/jquery.fancybox.min.css') }}
@endpush

@section('content')
<!-- PORTFOLIO -->

<section id="portfolio" class="module-sm">
	<ul v-list="type in types">
		
	</ul>

	<div class="container-fluid">
		
		<div class="row">
			<div class="col-sm-12">
				<h2 class="module-title font-alt">Portfolios</h2>
			</div>
		</div>

		<!-- FILTERS -->
		<div class="row">
			<div class="col-sm-12">
				<ul id="filters" class="filters font-alt">
				</ul>
			</div>
		</div>
		<!-- /FILTERS -->

		<div class="works-grid-wrapper">

			<!-- Portfolio 4 col + gutter -->
			<div id="works-grid" class="works-grid works-grid-gutter">

				<!-- Space for items -->

			</div>
		</div><!-- works-grid-wrapper -->

		<!-- SHOW MORE -->
		<!--
		<div class="row">
			<div class="col-sm-12">

				<div class="m-t-70 text-center">
					<button id="show-more" class="btn btn-dark show-more">More works</button>
				</div>

			</div>
		</div>
		-->
		<!-- /SHOW MORE -->

	</div>
</section>
<!-- /PORTFOLIO -->
@endsection

@push('scripts')
<script type="text/html" id="typeItem">
		<li><a href="#" class="@{{#current}}current@{{/current}}" data-filter="@{{code}}">@{{ name }}</a></li>	
</script>
<script type="text/html" id="portfolioItem">
	<!-- PORTFOLIO ITEM -->
		<div class="work-wrapper">
			<div class="work-thumbnail">
				<img src="@{{ thumbnail.saved_dir }}thumbnail/@{{ thumbnail.saved_name }}" alt="">
			</div>
			<div class="work-caption">
				<h3 class="work-title font-alt">@{{ name }}</h3>
				<span class="work-category font-serif"><a href="#">@{{#types}} @{{name}}@{{/types}}</a></span>
				<div>Updated in <strong>@{{ updated_at }}</strong></div>
			</div>
			<a data-fancybox data-type="ajax" data-src="{{url('/')}}/page/portfolioPop/@{{id}}" href="#" class="work-link"></a>
			<div class="icon-new-item">New</div>
		</div>
	<!-- /PORTFOLIO ITEM -->
</script>
{{ Html::script('/assets/common_lib/fancybox/jquery.fancybox.min.js') }}

{{ Html::script('/assets/front/js/portfolio.js') }}
{{ Html::script('/assets/front/js/portfolios.js') }}
{{ Html::script('/assets/front/js/portfolioView.js') }}
{{ Html::script('/assets/front/js/portfoliosView.js') }}

{{ Html::script('/assets/front/js/type.js') }}
{{ Html::script('/assets/front/js/types.js') }}
{{ Html::script('/assets/front/js/typeView.js') }}
{{ Html::script('/assets/front/js/typesView.js') }}

{{ Html::script('/assets/front/js/portfolioScript.js') }}

{{-- {{ Html::script('assets/front/js/vue_portfolio.js') }} --}}
@endpush