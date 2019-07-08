var TypesView = Backbone.View.extend({
	el:"#filters",
	initialize:function(){
		this.model.on("add", this.onAddType, this);
		this.model.on("sync", this.onAfterSync, this);

		this.model.add(new Type({name:"ALL", code:"*", current:true}));
		//this.model.add(new Type({name:"ALL", code:"*"}));
	},
	onAddType:function(type){
		var view = new TypeView({model:type});
		this.$el.append(view.render().$el);
	},
	onAfterSync:function(){
		// Rererence commonScript.js
		activeTypeBtn();
	},
	render:function(){
		return this;
	}

});