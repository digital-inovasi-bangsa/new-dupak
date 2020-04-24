/**
 * @author Kishor Mali
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteJabatan", function(){
		var idJabatan = $(this).data("idjabatan"),
			hitURL = baseURL + "jabatan/deleteJabatan",
			currentRow = $(this);
		
		var confirmation = confirm("Apakah anda yakin ingin menghapus data jabatan ?");
		
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
				if(data.status = true) { alert("Jabatan Berhasil Di Hapus"); }
				else if(data.status = false) { alert("Jabatan Gagal Di Hapus"); }
				else { alert("Akses Ditolak..!"); }
			});
		}
	});
	
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});
