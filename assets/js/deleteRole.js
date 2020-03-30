/**
 * @author Kishor Mali
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteRole", function(){
		var roleId = $(this).data("idrole"),
			hitURL = baseURL + "role/deleteRole",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this role ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { roleId : roleId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Role successfully deleted"); }
				else if(data.status = false) { alert("Role deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});
