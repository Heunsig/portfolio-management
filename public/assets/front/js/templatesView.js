var TemplatesView = Backbone.View.extend({
	el:"#works-grid",
	events:{},
	initialize:function(){
		this.model.on("add", this.onAddTemplate, this);
		this.model.on("sync", this.onAfterSync, this);

	},

	onAddTemplate:function(template){
		var view = new TemplateView({model:template});
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