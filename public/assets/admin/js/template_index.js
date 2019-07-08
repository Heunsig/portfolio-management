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
}