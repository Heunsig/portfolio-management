var TypeView = Backbone.View.extend({
	render:function(){
		var template = $("#typeItem").html();
		var html = Mustache.render(template, this.model.toJSON());
		this.$el = html;

		return this;
	}
});