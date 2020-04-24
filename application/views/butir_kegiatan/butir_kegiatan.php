<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Master Butir Kegiatan
      <small>Tambah, Ubah, Hapus</small>
    </h1>
  </section>

  <section class="content">
    <div class="row">
      <?php $this->load->view('includes/_flash'); ?>
    </div>

    <div class="row" style="width:70%">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title" style="margin-left: 12px">List Butir</h3>
          </div><!-- /.box-header -->
          <div class="card">
            <div class="form-group" style="margin-left: 20px;">
              <a class="btn btn-primary" href="<?php echo base_url(); ?>butir_kegiatan/addNew">Add New</a>
            </div>
            <div class="box-body table-responsive no-padding">
              <div class="card-body" style="padding: 20px;">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Butir Kegiatan</th>
                      <th>Nama Butir</th>
                      <th>Point</th>
                      <th>Edit</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(!empty($butirKegiatanRecords))
                    {
                        $no = 1;
                        foreach($butirKegiatanRecords as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $record->keterangan ?></td>
                      <td><?php echo $record->namaButir ?></td>
                      <td><?php echo $record->point ?></td>
                      <td>
                        <a href="<?php echo base_url().'butir_kegiatan/editOld/'.$record->idButirKegiatan; ?>"><i
                            class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;</a>
                        <a href="#" data-idbutirkegiatan="<?php echo $record->idButirKegiatan; ?>"
                          class="deleteButirKegiatan"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;</a>
                      </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div><!-- /.box-body -->
          </div>
        </div><!-- /.box -->
      </div>
    </div>
  </section>
</div>
<script>
  $(function () {
    $("#example1").DataTable({
      "columns": [{
          "width": "5%"
        },
        {
          "width": "30%"
        },
        {
          "width": "30%"
        },
        {
          "width": "10%"
        }
      ],
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": false,
      "autoWidth": false,
      "pageLength": 5
    });
  });
</script>
<script>
  jQuery(document).ready(function () {

    jQuery(document).on("click", ".deleteButirKegiatan", function () {
      var idButirKegiatan = $(this).data("idbutirkegiatan"),
        hitURL = '<?php echo base_url() ?>' + 'butir_kegiatan/deleteButir',
        currentRow = $(this);

      var confirmation = confirm("Are you sure to delete this butir ?");

      if (confirmation) {
        jQuery.ajax({
          type: "POST",
          dataType: "json",
          url: hitURL,
          data: {
            idButirKegiatan: idButirKegiatan,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
          }
        }).done(function (data) {
          console.log(data);
          currentRow.parents('tr').remove();
          if (data.status = true) {
            alert("Butir successfully deleted");
            location.reload();
          } else if (data.status = false) {
            alert("Butir deletion failed");
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

