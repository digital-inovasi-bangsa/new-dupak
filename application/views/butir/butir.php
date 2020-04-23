<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Master Butir
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
            <div class="form-group" style="margin-left: 20px;margin-bottom: -50px;">
              <a class="btn btn-primary" href="<?php echo base_url(); ?>butir/addNew">Add New</a>
            </div>
            <div class="box-body table-responsive no-padding">
              <div class="card-body" style="padding: 20px;">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Butir</th>
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
              </div>
              <!-- /.card-body -->
            </div><!-- /.box-body -->
          </div>
        </div><!-- /.box -->
      </div>
    </div>
  </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/deleteButir.js" charset="utf-8"></script>
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