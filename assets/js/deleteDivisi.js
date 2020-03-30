/**
 * @author Kishor Mali
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteDivisi", function(){
		var idDivisi = $(this).data("iddivisi"),
			hitURL = baseURL + "divisi/deleteDivisi",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this divisi ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { idDivisi : idDivisi } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Divisi successfully deleted"); }
				else if(data.status = false) { alert("Divisi deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});
