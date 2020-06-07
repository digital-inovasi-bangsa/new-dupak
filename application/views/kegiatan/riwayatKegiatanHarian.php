<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    <?= $pageTitle; ?>
    </h1>
  </section>

  <section class="content">
    <div class="row">
      <?php $this->load->view('includes/_flash'); ?>
    </div>

    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"><?= $pageTitle; ?></h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="box-body table-responsive no-padding">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIP</th>
                      <th>Nama</th>
                      <th>Pangkat</th>
                      <th>Jabatan</th>
                      <th>Tanggal Mulai-Selesai</th>
                      <th>Tanggal Diajukan</th>
                      <th>Tanggal Diperbarui</th>
                      <th>Unsur</th>
                      <th>Subunsur</th>
                      <th>Butir Kegiatan</th>
                      <th>Catatan</th>
                      <th>Status</th>
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
                      <td><?php echo $record->createdAt ?></td>
                      <td><?php echo $record->updatedAt ?></td>
                      <td><?php echo $record->namaUnsur ?></td>
                      <td><?php echo $record->namaSubunsur ?></td>
                      <td><?php echo $record->namaButir ?></td>
                      <td><?php echo $record->catatan ?></td> 
                      <?php if($record->status=='Diterima') { ?>
                      <td><span class="label" style="background-color:green"><?php echo $record->status ?></span></td>
                      <?php } else if($record->status=='Ditolak') {?> 
                        <td><span class="label" style="background-color:red"><?php echo $record->status ?></span></td>
                      <?php } else if($record->status=='Belum Upload Bukti') {?> 
                        <td><span class="label" style="background-color:gray"><?php echo $record->status ?></span></td>
                        <?php } else if($record->status=='Diajukan') {?> 
                        <td><span class="label" style="background-color:purple"><?php echo $record->status ?></span></td>
                        <?php } else {?> 
                        <td><span class="label" style="background-color:black"><?php echo $record->status ?></span></td>
                      <?php } ?>
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