function documentReady(){
	var types = new Types();
	types.fetch();
	var typesView = new TypesView({model:types});

	var portfolios = new Portfolios();
	portfolios.fetch();
	var portfoliosView = new PortfoliosView({model:portfolios});

	Backbone.history.start();

	/*$("[data-fancybox]").fancybox({
		afterLoad : function(){
			var $a = $(".portfolio_imgs");
			$a.imagesLoaded().progress(function(){
				$(".portfolio_imgs").masonry();
			});
		}
	});*/
	/*$("[data-fancybox]").fancybox({
		afterLoad : function(){
			var $a = $(".portfolio_imgs");
			$a.imagesLoaded().progress(function(){
				$(".portfolio_imgs").masonry();
			});
		}
	});*/
}	