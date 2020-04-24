/**
 * @author Kishor Mali
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteRole", function(){
		var roleId = $(this).data("idrole"),
			hitURL = baseURL + "role/deleteRole",
			currentRow = $(this);
		
		var confirmation = confirm("Apakah anda yakin ingin menghapus data role ?");
		
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
				if(data.status = true) { alert("Role Berhasil Di Hapus"); }
				else if(data.status = false) { alert("Role Gagal Di Hapus"); }
				else { alert("Akses Ditolak..!"); }
			});
		}
	});
	
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});
