var Portfolio = Backbone.Model.extend({
	defaults:{
		thumbnail:null,
		types:null,
		bool_newest:false
	},
	initialize:function(attrs){
		if(attrs.bool_newest == true){
			//console.log(this);
			
		//console.log($('body').children("#"+this.id));
		}
	},
	validate:function(attrs){
		console.log(attrs);
	}
});