function documentReady(){
	$( "#itemListTbl" ).sortable({
		items:"tbody > tr",
		handle:".order_handle",
		update:function(e, ui){
			var tblType = $('#itemListTbl').data('tbl-type'); 
			var sortedIDs = $("#itemListTbl").sortable("toArray",{attribute:"data-id"});

			$.ajax({
				method:"PUT",
				url:"/relocateListOrder/"+tblType,
				dataType:"json",
				data:{"sortedIds[]":sortedIDs},
				success:function(data){
					console.log(data);
				}
			});
		}
	});
	$( "#itemListTbl" ).disableSelection();

	/*$("#listCount").on('change',function(e){
		console.log(window.location);
		var origin = window.location.origin,
			pathname = window.location.pathname,
			search = window.location.search,
			value = e.currentTarget.selectedOptions[0].value;

			if(!search){
				window.location.replace(origin + pathname + "?listCount=" + value);
			}else{
				window.location.replace(origin + pathname + search + "&listCount=" + value);
			}

		//window.location.replace(origin + pathname + "?listCount=" + value)
	});*/

}