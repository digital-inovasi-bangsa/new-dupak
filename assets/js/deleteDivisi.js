/**
 * @author Kishor Mali
 */


jQuery(document).ready(function () {

	jQuery(document).on("click", ".deleteDivisi", function () {
		var idDivisi = $(this).data("iddivisi"),
			hitURL = baseURL + "divisi/deleteDivisi",
			currentRow = $(this);

		var confirmation = confirm("Apakah anda yakin ingin menghapus data divisi ?");

		if (confirmation) {
			jQuery.ajax({
				type: "POST",
				dataType: "json",
				url: hitURL,
				data: {
					idDivisi: idDivisi
				}
			}).done(function (data) {
				console.log(data);
				currentRow.parents('tr').remove();
				if (data.status == true) {
					console.log('berhasil');
					alert("Divisi Berhasil Di Hapus");
				} else if (data.status == false) {
					console.log('gagal');
					alert("Divisi Gagal Di Hapus");
				} else {
					alert("Akses Ditolak..!");
				}
			}).fail(function(xhr, status, error) {
				console.log(data.status == false);
				console.log(status);
			});;
		}
	});


	jQuery(document).on("click", ".searchList", function () {

	});

});