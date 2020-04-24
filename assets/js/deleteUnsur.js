/**
 * @author Kishor Mali
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteUnsur", function(){
		var idUnsur = $(this).data("idunsur"),
			hitURL = baseURL + "unsur/deleteUnsur",
			currentRow = $(this);
		
		var confirmation = confirm("Apakah anda yakin ingin menghapus data unsur ?");
		
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
				if(data.status = true) { alert("Unsur Berhasil Di Hapus"); }
				else if(data.status = false) { alert("Unsur Gagal Di Hapus"); }
				else { alert("Akses Ditolak..!"); }
			});
		}
	});
	
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});
