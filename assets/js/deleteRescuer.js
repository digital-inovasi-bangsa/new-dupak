/**
 * @author Kishor Mali
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteUser", function(){
		var userId = $(this).data("iduser"),
			hitURL = baseURL + "rescuer/deleteUser",
			currentRow = $(this);
		
		var confirmation = confirm("Apakah anda yakin ingin menghapus data ini ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { userId : userId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("User Berhasil Di Hapus"); }
				else if(data.status = false) { alert("User Gagal Di Hapus"); }
				else { alert("Akses Ditolak..!"); }
			});
		}
	});
	
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});
