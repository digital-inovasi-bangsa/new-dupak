<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Master Divisi
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
            <h3 class="box-title" style="margin-left: 12px">List Divisi</h3>
          </div><!-- /.box-header -->
          <div class="card">
            <div class="form-group" style="margin-left: 20px;margin-bottom: -50px;">
              <a class="btn btn-primary" href="<?php echo base_url(); ?>divisi/addNew">Add New</a>
            </div>
            <div class="box-body table-responsive no-padding">
              <div class="card-body" style="padding: 20px;">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Divisi</th>
                      <th>Edit</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(!empty($divisiRecords))
                    {
                        $no = 1;
                        foreach($divisiRecords as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $record->namaDivisi ?></td>
                      <td>
                        <a href="<?php echo base_url().'divisi/editOld/'.$record->idDivisi; ?>"><i
                            class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;</a>
                        <a href="#" data-iddivisi="<?php echo $record->idDivisi; ?>" class="deleteDivisi"><i
                            class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;</a>
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
  jQuery(document).ready(function () {

    jQuery(document).on("click", ".deleteDivisi", function () {
      var idDivisi = $(this).data("iddivisi"),
        hitURL = '<?php echo base_url() ?>' + 'divisi/deleteDivisi',
        currentRow = $(this);

      var confirmation = confirm("Are you sure to delete this divisi ?");

      if (confirmation) {
        jQuery.ajax({
          type: "POST",
          dataType: "json",
          url: hitURL,
          data: ({
            idDivisi: idDivisi,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
          })
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
        }).fail(function (xhr, status, error) {
          console.log(status);
        });;
      }
    });


    jQuery(document).on("click", ".searchList", function () {

    });

  });
</script>
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