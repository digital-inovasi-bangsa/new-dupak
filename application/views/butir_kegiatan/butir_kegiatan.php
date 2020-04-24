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

    <div class="row" style="width:70%">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title" style="margin-left: 12px"><?= $pageTitle; ?></h3>
          </div><!-- /.box-header -->
          <div class="card">
            <div class="form-group" style="margin-left: 20px;">
              <a class="btn btn-primary" href="<?php echo base_url(); ?>butir_kegiatan/addNew">Tambahkan Data</a>
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
<script src="http://localhost/DIB/new-dupak/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/jquery-ui/jquery-ui.min.js" type="text/javascript">
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/deleteButirKegiatan.js" charset="utf-8"></script>
