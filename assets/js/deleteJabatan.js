/**
 * @author Kishor Mali
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteJabatan", function(){
		var idJabatan = $(this).data("idjabatan"),
			hitURL = baseURL + "jabatan/deleteJabatan",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this jabatan ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { idJabatan : idJabatan } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Jabatan successfully deleted"); }
				else if(data.status = false) { alert("Jabatan deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});
