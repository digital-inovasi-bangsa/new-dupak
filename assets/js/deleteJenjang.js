/**
 * @author Kishor Mali
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteJenjang", function(){
		var idJenjang = $(this).data("idjenjang"),
			hitURL = baseURL + "jenjang/deleteJenjang",
			currentRow = $(this);
		
		var confirmation = confirm("Apakah anda yakin ingin menghapus data jenjang ?");
		
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
				if(data.status = true) { alert("Jenjang Berhasil Di Hapus"); }
				else if(data.status = false) { alert("Jenjang Gagal Di Hapus"); }
				else { alert("Akses Ditolak..!"); }
			});
		}
	});
	
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});
