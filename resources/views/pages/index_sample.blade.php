@extends('main')

@section('content')
<!-- HERO -->
<section id="hero" class="module-hero bg-dark-30 js-fullheight" data-background="assets/front/images/module-1.jpg">

	<!-- HERO TEXT -->
	<div class="hero-caption">
		<div class="hero-text">
			<h6 class="m-b-30">Photo-a-day by</h6>
			<h1 class="m-b-30">Andrew Black</h1>
			<h6 class="m-b-60">Creative Wedding Photographer</h6>
			<a href="#portfolio" class="btn btn-dark anim-scroll">Learn More</a>
		</div>
	</div>
	<!-- /HERO TEXT -->

</section>
<!-- /HERO -->

<!-- PORTFOLIO -->
<section id="portfolio" class="module-sm">
	<div class="container-fluid">

		<!-- FILTERS -->
		<div class="row">
			<div class="col-sm-12">
				<ul id="filters" class="filters font-alt">
					<li><a href="#" class="current" data-filter="*">All</a></li>
					<li><a href="#" data-filter=".fashion">Fashion</a></li>
					<li><a href="#" data-filter=".travel">Travel</a></li>
					<li><a href="#" data-filter=".music">Music</a></li>
					<li><a href="#" data-filter=".video">Video</a></li>
				</ul>
			</div>
		</div>
		<!-- /FILTERS -->

		<div class="works-grid-wrapper">

			<div id="works-grid" class="works-grid works-grid-gutter">

				<!-- PORTFOLIO ITEM -->
				<article class="work-item travel video">
					<div class="work-wrapper">
						<div class="work-thumbnail">
							<img src="assets/front/images/portfolio-1.jpg" alt="">
						</div>
						<div class="work-caption">
							<h3 class="work-title font-alt">Montures</h3>
							<span class="work-category font-serif"><a href="#">Travel, Video</a></span>
						</div>
						<a href="portfolio-single-1.html" class="work-link"></a>
					</div>
				</article>
				<!-- /PORTFOLIO ITEM -->

				<!-- PORTFOLIO ITEM -->
				<article class="work-item fashion">
					<div class="work-wrapper">
						<div class="work-thumbnail">
							<img src="assets/front/images/portfolio-8.jpg" alt="">
						</div>
						<div class="work-caption">
							<h3 class="work-title font-alt">Rambler & Co</h3>
							<span class="work-category font-serif"><a href="#">Fashion</a></span>
						</div>
						<a href="portfolio-single-1.html" class="work-link"></a>
					</div>
				</article>
				<!-- /PORTFOLIO ITEM -->

				<!-- PORTFOLIO ITEM -->
				<article class="work-item music">
					<div class="work-wrapper">
						<div class="work-thumbnail">
							<img src="assets/front/images/portfolio-2.jpg" alt="">
						</div>
						<div class="work-caption">
							<h3 class="work-title font-alt">Pink Lips</h3>
							<span class="work-category font-serif"><a href="#">Music</a></span>
						</div>
						<a href="portfolio-single-1.html" class="work-link"></a>
					</div>
				</article>
				<!-- /PORTFOLIO ITEM -->

				<!-- PORTFOLIO ITEM -->
				<article class="work-item fashion">
					<div class="work-wrapper">
						<div class="work-thumbnail">
							<img src="assets/front/images/portfolio-3.jpg" alt="">
						</div>
						<div class="work-caption">
							<h3 class="work-title font-alt">Brother</h3>
							<span class="work-category font-serif"><a href="#">Fashion</a></span>
						</div>
						<a href="portfolio-single-1.html" class="work-link"></a>
					</div>
				</article>
				<!-- /PORTFOLIO ITEM -->

				<!-- PORTFOLIO ITEM -->
				<article class="work-item travel">
					<div class="work-wrapper">
						<div class="work-thumbnail">
							<img src="assets/front/images/portfolio-4.jpg" alt="">
						</div>
						<div class="work-caption">
							<h3 class="work-title font-alt">Travel Bags</h3>
							<span class="work-category font-serif"><a href="#">Travel</a></span>
						</div>
						<a href="portfolio-single-1.html" class="work-link"></a>
					</div>
				</article>
				<!-- /PORTFOLIO ITEM -->

				<!-- PORTFOLIO ITEM -->
				<article class="work-item music">
					<div class="work-wrapper">
						<div class="work-thumbnail">
							<img src="assets/front/images/portfolio-5.jpg" alt="">
						</div>
						<div class="work-caption">
							<h3 class="work-title font-alt">Workshop</h3>
							<span class="work-category font-serif"><a href="#">Music</a></span>
						</div>
						<a href="portfolio-single-1.html" class="work-link"></a>
					</div>
				</article>
				<!-- /PORTFOLIO ITEM -->

				<!-- PORTFOLIO ITEM -->
				<article class="work-item travel">
					<div class="work-wrapper">
						<div class="work-thumbnail">
							<img src="assets/front/images/portfolio-6.jpg" alt="">
						</div>
						<div class="work-caption">
							<h3 class="work-title font-alt">The Handkerchief</h3>
							<span class="work-category font-serif"><a href="#">Travel</a></span>
						</div>
						<a href="portfolio-single-1.html" class="work-link"></a>
					</div>
				</article>
				<!-- /PORTFOLIO ITEM -->

				<!-- PORTFOLIO ITEM -->
				<article class="work-item fashion">
					<div class="work-wrapper">
						<div class="work-thumbnail">
							<img src="assets/front/images/portfolio-7.jpg" alt="">
						</div>
						<div class="work-caption">
							<h3 class="work-title font-alt">Architecture</h3>
							<span class="work-category font-serif"><a href="#">Fashion</a></span>
						</div>
						<a href="portfolio-single-1.html" class="work-link"></a>
					</div>
				</article>
				<!-- /PORTFOLIO ITEM -->

			</div>

		</div><!-- works-grid-wrapper -->

		<!-- SHOW MORE -->
		<div class="row">
			<div class="col-sm-12">

				<div class="m-t-70 text-center">
					<button id="show-more" class="btn btn-dark show-more">More works</button>
				</div>

			</div>
		</div>
		<!-- /SHOW MORE -->

	</div>
</section>
<!-- /PORTFOLIO -->
@endsection