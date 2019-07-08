function documentReady(){
	var types = new Types();
	types.fetch();
	var typesView = new TypesView({model:types});

	var templates = new Templates();
	templates.fetch();
	var templatesView = new TemplatesView({model:templates});

	Backbone.history.start();
}	