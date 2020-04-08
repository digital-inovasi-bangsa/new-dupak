<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Approval Kegiatan
    </h1>
  </section>

  <section class="content">
    <div class="row">
      <?php $this->load->view('includes/_flash'); ?>
    </div>

    <div class="row" style="width:100%">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title" style="margin-left: 12px">List Kegiatan</h3>
          </div><!-- /.box-header -->
          <div class="card">
            <div class="box-body table-responsive no-padding">
              <div class="card-body" style="padding: 20px;">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIP</th>
                      <th>Nama</th>
                      <th>Pangkat</th>
                      <th>Jabatan</th>
                      <th>Tanggal Mulai-Selesai</th>
                      <th>Surat Tugas</th>
                      <th>Dokumentasi</th>
                      <th>Laporan Kegiatan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(!empty($kegiatan))
                    {
                        $no = 1;
                        foreach($kegiatan as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $record->nip ?></td>
                      <td><?php echo $record->name ?></td>
                      <td><?php echo $record->namaJabatan ?></td>
                      <td><?php echo $record->namaPangkat ?></td>
                      <td><?php echo $record->tanggalMulai ?> - <?php echo $record->tanggalSelesai ?></td>
                      <td><a href="<?php echo base_url()?>upload/dokumentasi/<?php echo $record->path_surat_kegiatan ?>" download><?php echo $record->path_surat_kegiatan ?></td>
                      <td><a href="<?php echo base_url()?>upload/dokumentasi/<?php echo $record->path_dokumentasi ?>" download><?php echo $record->path_dokumentasi ?></td>
                      <td><a href="<?php echo base_url()?>upload/dokumentasi/<?php echo $record->path_laporan_kegiatan ?>" download><?php echo $record->path_laporan_kegiatan ?></td>
                      <td>
                        <a href="<?php echo base_url().'editOld/'.$record->idKegiatanHarian; ?>"><i
                            class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;</a>
                        <a href="#" data-userid="<?php echo $record->idKegiatanHarian; ?>" class="deleteUser"><i
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "columns": [{
          "width": "3%"
        },
        {
          "width": "10%"
        },
        {
          "width": "10%"
        },
        {
          "width": "10%"
        },
        {
          "width": "10%"
        },
        {
          "width": "10%"
        },
        {
          "width": "10%"
        },
        {
          "width": "10%"
        },
        {
          "width": "10%"
        },
        {
          "width": "10%"
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
