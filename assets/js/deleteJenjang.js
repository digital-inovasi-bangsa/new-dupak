/**
 * @author Kishor Mali
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteJenjang", function(){
		var idJenjang = $(this).data("idjenjang"),
			hitURL = baseURL + "jenjang/deleteJenjang",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this jenjang ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { idJenjang : idJenjang } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Jenjang successfully deleted"); }
				else if(data.status = false) { alert("Jenjang deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});
