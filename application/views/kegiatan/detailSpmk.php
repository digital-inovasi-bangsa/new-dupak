<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Detail Spmk
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url() ?>kegiatan/kegiatan"><i class="fa fa-dashboard"></i> Kegiatan</a></li>
      <li><a href="<?php echo base_url() ?>kegiatan/spmk">Spmk</a></li>
      <li class="active">Detail Spmk</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          Detail Spmk
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-3">
      </div>
      <!-- /.col -->
      <div class="col-sm-6">
        <h4 class="text-center">SURAT PERNYATAAN<br>MELAKUKAN KEGIATAN
          <?php echo $kegiatan[0]['namaUnsur'] ?><br><br><br><br></h4>
      </div>
      <!-- /.col -->
      <div class="col-sm-3">
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row invoice-info">
      <div class="col-sm-5">
        <p>Yang bertanda tangan dibawah ini</p>
        <p>Nama</p>
        <p>NIP</p>
        <p>Pangkat/golongan ruang</p>
        <p>Jabatan</p>
        <p>Unit Kerja</p>
        <p>Menyatakan bahwa</p>
        <p>Nama</p>
        <p>NIP</p>
        <p>Pangkat/golongan ruang</p>
        <p>Jabatan</p>
        <p>Unit Kerja</p>
        <p>telah mengikuti <?php echo $kegiatan[0]['namaUnsur'] ?> sebagai berikut</p>
      </div>
      <!-- /.col -->
      <div class="col-sm-7">
        <p>: </p>
        <p>: <?php echo $atasan->name ?></p>
        <p>: <?php echo $atasan->nip ?></p>
        <p>: <?php echo $atasan->namaJabatan ?></p>
        <p>: <?php echo $atasan->namaPangkat ?></p>
        <p>: <?php echo $atasan->namaDivisi ?></p>
        <p>: </p>
        <p>: <?php echo $user->name ?></p>
        <p>: <?php echo $user->nip ?></p>
        <p>: <?php echo $user->namaJabatan ?></p>
        <p>: <?php echo $user->namaPangkat ?></p>
        <p>: <?php echo $user->namaDivisi ?></p>
        <p>: </p>
      </div>
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Kegiatan</th>
              <th>Periode</th>
              <th>Angka Kredit</th>
              <th>Volume</th>
              <th>Total Angka Kredit</th>
            </tr>
          </thead>
          <tbody>
            <?php
if (!empty($kegiatan)) {
    $no = 1;
    $arr = 0;
    foreach ($kegiatan as $record) {
        ?>
            <tr>
              <td><?php echo $no++ ?></td>
              <td><?php echo $record['keterangan'] ?></td>
              <td><?php echo $periode ?></td>
              <td><?php echo $record['poin'] ?></td>
              <td><?php echo $record['volume'] ?></td>
              <td><?php echo $record['point'] ?></td>
            </tr>
            <?php
}
}
?>
            <tr>
              <td colspan="4" class="text-right">Total</td>
              <td><?php echo $total[0]->volume ?></td>
              <td><?php echo $total[0]->poin ?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row invoice-info">
      <div class="col-sm-3">
      </div>
      <!-- /.col -->
      <div class="col-sm-6">
      </div>
      <!-- /.col -->
      <div class="col-sm-3">
        <p class="text-center">Mengetahui,</p>
        <p class="text-center">Atasan Langsung</p>
        <br><br><br><br>
        <p class="text-center"><?php echo $atasan->name ?></p>
        <p class="text-center"><?php echo $atasan->nip ?></p>
        <br><br>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
      <div class="col-xs-12">
        <a href="<?php echo base_url() . 'kegiatan/printSpmk/' . $kegiatan[0]['idKegiatanHarian']; ?>" target="_blank"
          class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-print"></i> Print</a>
      </div>
    </div>
  </section>
</div>