/**
 * @author Kishor Mali
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteUnsur", function(){
		var idUnsur = $(this).data("idunsur"),
			hitURL = baseURL + "unsur/deleteUnsur",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this unsur ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { idUnsur : idUnsur } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Unsur successfully deleted"); }
				else if(data.status = false) { alert("Unsur deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});
