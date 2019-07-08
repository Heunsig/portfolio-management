var Template = Backbone.Model.extend({
	defaults:{
		thumbnail:null,
		types:null
	},
	validate:function(attrs){
		console.log(attrs);
	}
});