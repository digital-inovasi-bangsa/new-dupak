/**
 * @author Kishor Mali
 */


jQuery(document).ready(function () {

	jQuery(document).on("click", ".deleteDivisi", function () {
		var idDivisi = $(this).data("iddivisi"),
			hitURL = baseURL + "divisi/deleteDivisi",
			currentRow = $(this);

		var confirmation = confirm("Are you sure to delete this divisi ?");

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
					alert("Divisi successfully deleted");
				} else if (data.status == false) {
					console.log('gagal');
					alert("Divisi deletion failed");
				} else {
					alert("Access denied..!");
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