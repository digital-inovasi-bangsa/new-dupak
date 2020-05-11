<div class="content-wrapper">
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
      <div class="col-xs-12 col-md-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"><?= $pageTitle; ?></h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="form-group">
              <a class="btn btn-primary" href="<?php echo base_url(); ?>butir/addNew">Tambahkan Data</a>
            </div>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Butir</th>
                      <th>Nama Unsur</th>
                      <th>Nama Subunsur</th>
                      <th>Edit</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(!empty($butirRecords))
                    {
                        $no = 1;
                        foreach($butirRecords as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $record->namaButir ?></td>
                      <td><?php echo $record->namaUnsur ?></td>
                      <td><?php echo $record->namaSubunsur ?></td>
                      <td>
                        <a href="<?php echo base_url().'butir/editOld/'.$record->idButir; ?>"><i
                            class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;</a>
                        <a href="#" data-idbutir="<?php echo $record->idButir; ?>" class="deleteButir"><i
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

    jQuery(document).on("click", ".deleteButir", function () {
      var idButir = $(this).data("idbutir"),
        hitURL = '<?php echo base_url() ?>' + 'butir/deleteButir',
        currentRow = $(this);

      var confirmation = confirm("Apakah kamu yakin menghapus data butir ?");

      if (confirmation) {
        jQuery.ajax({
          type: "POST",
          dataType: "json",
          url: hitURL,
          data: {
            idButir: idButir,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
          }
        }).done(function (data) {
          console.log(data);
          currentRow.parents('tr').remove();
          if (data.status = true) {
            alert("Butir Berhasil Dihapus!");
            location.reload();
          } else if (data.status = false) {
            alert("Butir Gagal Dihapus");
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
      "autoWidth": true,
    });
  });
</script>