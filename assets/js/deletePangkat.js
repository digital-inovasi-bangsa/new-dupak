/**
 * @author Kishor Mali
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deletePangkat", function(){
		var idPangkat = $(this).data("idpangkat"),
			hitURL = baseURL + "pangkat/deletePangkat",
			currentRow = $(this);
		
		var confirmation = confirm("Apakah anda yakin ingin menghapus data pangkat ?");
		
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
				if(data.status = true) { alert("Pangkat Berhasil Di Hapus"); }
				else if(data.status = false) { alert("Pangkat Gagal Di Hapus"); }
				else { alert("Akses Ditolak..!"); }
			});
		}
	});
	
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});
