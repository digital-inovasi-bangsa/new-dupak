/**
 * @author Kishor Mali
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteButirKegiatan", function(){
		var idButirKegiatan = $(this).data("idbutirkegiatan"),
			hitURL = baseURL + "butir_kegiatan/deleteButir",
			currentRow = $(this);
		
		var confirmation = confirm("Apakah anda yakin ingin menghapus data butir ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { idButirKegiatan : idButirKegiatan } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Butir Berhasil Di Hapus"); }
				else if(data.status = false) { alert("Butir Gagal Di Hapus"); }
				else { alert("Akses Ditolak..!"); }
			});
		}
	});
	
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});
