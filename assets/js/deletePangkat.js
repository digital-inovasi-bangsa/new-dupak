/**
 * @author Kishor Mali
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deletePangkat", function(){
		var idPangkat = $(this).data("idpangkat"),
			hitURL = baseURL + "pangkat/deletePangkat",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this pangkat ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { idPangkat : idPangkat } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Pangkat successfully deleted"); }
				else if(data.status = false) { alert("Pangkat deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});
