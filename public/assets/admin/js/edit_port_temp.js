////////////
// legacy //
////////////
function documentReady(){
	$(".btn-delete-image").on("click", onDeleteBtnClick);

	/*-------------------
	 * Relocate Images order
	 *------------------*/
	$( "#updatedImagesBox" ).sortable({
		handle: ".order_handle",
		update:function(e, ui){
			var itemType = $('#updatedImagesBox').data('item-type'); 
			var itemId = $('#updatedImagesBox').data('item-id');
			var sortedIDs = $( "#updatedImagesBox" ).sortable("toArray",{attribute:"data-id"});

			$.ajax({
				method:"PUT",
				url:"/relocateImageOrder/"+itemType+"/"+itemId,
				dataType:"json",
				data:{"sortedIds[]":sortedIDs},
				success:function(data){
					console.log(data);
				}
			});
		}
    });
	$( ".list-group" ).disableSelection();
}

// Add input that will be deleted files
function onDeleteBtnClick(){
	var input = $("<input>").attr({
		'type':'hidden',
		'name':'images_to_delete[]'
	});
	
	input.val($(this).data('id'));

	$(this).parents('form').append(input);
	$(this).parents('li').remove();
}
