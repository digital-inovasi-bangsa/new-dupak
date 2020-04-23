/**
 * @author Kishor Mali
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteSubunsur", function(){
		var idSubunsur = $(this).data("idsubunsur"),
			hitURL = baseURL + "subunsur/deleteSubunsur",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this subunsur ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { idSubunsur : idSubunsur } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Subunsur successfully deleted"); }
				else if(data.status = false) { alert("Subunsur deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});
