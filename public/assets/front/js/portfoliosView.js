var PortfoliosView = Backbone.View.extend({
	el:"#works-grid",
	events:{},
	initialize:function(){
		this.model.on("add", this.onAddPortfolio, this);
		this.model.on("sync", this.onAfterSync, this);

	},

	onAddPortfolio:function(portfolio){
		//console.log(portfolio);
		var view = new PortfolioView({model:portfolio});
		this.$el.append(view.render().$el);
	},
	onAfterSync:function(){
		// Rererence commonScript.js
		afterImagesLoaded();

		// Masonry after Ajax Page load
		$("[data-fancybox]").fancybox({
			afterLoad : function(){
				var $a = $(".portfolio_imgs");
				$a.imagesLoaded().progress(function(){
					$(".portfolio_imgs").masonry();
				});
			}
		});

	},
	render : function(){
		return this;
	}
});