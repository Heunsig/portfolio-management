function documentReady(){
	var app = new Vue({
		delimiters: ['${', '}'],
		el:'#portfolio',
		data:{
			test:"aaa",
			types:[],
			items:[]
		},
		methods:{
			fetchTypes:function(){
				var $this = this;
				$.ajax({
					url:"http://new.catchasoft.com/get/types",
					method:"GET",
					dataType:"JSON",
					success:function(data){
						$this.items = data;
					},error:function(){

					}
				});
			}
		}
	});

	//app.fetchTypes();

}