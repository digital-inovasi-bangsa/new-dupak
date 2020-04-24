/**
 * @author Kishor Mali
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteSubunsur", function(){
		var idSubunsur = $(this).data("idsubunsur"),
			hitURL = baseURL + "subunsur/deleteSubunsur",
			currentRow = $(this);
		
		var confirmation = confirm("Apakah anda yakin ingin menghapus data subunsur ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { idSubunsur : idSubunsur } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Subunsur Berhasil Di Hapus"); }
				else if(data.status = false) { alert("Subunsur Gagal Di Hapus"); }
				else { alert("Akses Ditolak..!"); }
			});
		}
	});
	
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});
