var PortfolioView = Backbone.View.extend({
	tagName:"article",
	initialize:function(options){
		
	},
	render:function(){
		var self = this;

		this.$el.attr("id", this.model.id);
		this.$el.addClass('work-item');

		_.each(this.model.get('types'), function(attr){
			self.$el.addClass(attr.code);
		});

		var template = $('#portfolioItem').html();
		var html = Mustache.render(template, this.model.toJSON());
		this.$el.html(html);

		return this;
	}
	
});