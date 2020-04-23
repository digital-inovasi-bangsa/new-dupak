/**
 * @author Kishor Mali
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteButir", function(){
		var idButir = $(this).data("idbutir"),
			hitURL = baseURL + "butir/deleteButir",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this butir ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { idButir : idButir } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Butir successfully deleted"); }
				else if(data.status = false) { alert("Butir deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});
