<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    <?= $pageTitle; ?>
      <small>Tambah, Ubah, Hapus</small>
    </h1>
  </section>

  <section class="content">
    <div class="row">
      <?php $this->load->view('includes/_flash'); ?>
    </div>

    <div class="row">
      <div class="col-xs-12 col-md-6">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"><?= $pageTitle; ?></h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="form-group">
              <a class="btn btn-primary" href="<?php echo base_url(); ?>jenjang/addNew">Tambahkan Data</a>
            </div>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Jenjang</th>
                      <th>Edit</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(!empty($jenjangRecords))
                    {
                        $no = 1;
                        foreach($jenjangRecords as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $record->namaJenjang ?></td>
                      <td>
                        <a href="<?php echo base_url().'jenjang/editOld/'.$record->idJenjang; ?>"><i
                            class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;</a>
                        <a href="#" data-idjenjang="<?php echo $record->idJenjang; ?>" class="deleteJenjang"><i
                            class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;</a>
                      </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                  </tbody>
                </table>
              <!-- /.card-body -->
            </div><!-- /.box-body -->
          </div>
        </div><!-- /.box -->
      </div>
    </div>
  </section>
</div>
<script>
  jQuery(document).ready(function () {

    jQuery(document).on("click", ".deleteJenjang", function () {
      var idJenjang = $(this).data("idjenjang"),
        hitURL = '<?php echo base_url() ?>' + 'jenjang/deleteJenjang',
        currentRow = $(this);

      var confirmation = confirm("Apakah kamu yakin menghapus data jenjang ?");

      if (confirmation) {
        jQuery.ajax({
          type: "POST",
          dataType: "json",
          url: hitURL,
          data: {
            idJenjang: idJenjang,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
          }
        }).done(function (data) {
          console.log(data);
          currentRow.parents('tr').remove();
          if (data.status = true) {
            alert("Jenjang Berhasil Dihapus!");
            location.reload();
          } else if (data.status = false) {
            alert("Jenjang Gagal Dihapus");
          } else {
            alert("Access denied..!");
          }
        });
      }
    });


    jQuery(document).on("click", ".searchList", function () {

    });

  });
</script>
<script>
  $(function () {
    $("#example1").DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>