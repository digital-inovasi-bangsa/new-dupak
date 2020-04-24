<?php

$user = '';

if (!empty($data)) {
  foreach ($data as $uf) {
    $user = $uf->jumlahUser;
  }
}
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?= $pageTitle; ?>
      <small>Control panel</small>
    </h1>
  </section>

  <section class="content">
    <div class="row">
      <?php
      if ($role == ROLE_ADMIN || $role == ROLE_MANAGER) {
      ?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $jumlahUser ?></h3>
              <p>Total Pegawai</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?php echo base_url(); ?>user/userListing" class="small-box-footer">Lebih Lanjut <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div><!-- ./col -->
      <?php
      }
      ?>
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
          <div class="inner">
            <h3><?php echo $jumlahKegiatan ?></h3>
            <p>Total Kegiatan yang belum Approve</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="<?php echo base_url(); ?>kegiatan/approvalKegiatan" class="small-box-footer">Lebih Lanjut <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?php echo $kegiatanPegawaiDiterima[0]->jmlPoint ?></h3>
            <p>Jumlah Point Diterima</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="<?php echo base_url(); ?>kegiatan/kegiatan" class="small-box-footer">Lebih Lanjut <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3><?php echo $kegiatanPegawaiDitolak[0]->jmlPoint ?></h3>
            <p>Jumlah Point Ditolak</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="<?php echo base_url(); ?>kegiatan/kegiatan" class="small-box-footer">Lebih Lanjut <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
    </div>
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-orange">
          <div class="inner">
            <h3><?php echo $kegiatanPegawaiDiterima[0]->jmlKegiatan ?></h3>
            <p>Jumlah Kegiatan Diterima</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="<?php echo base_url(); ?>kegiatan/kegiatan" class="small-box-footer">Lebih Lanjut <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-purple">
          <div class="inner">
            <h3><?php echo $kegiatanPegawaiDitolak[0]->jmlKegiatan ?></h3>
            <p>Jumlah Kegiatan Ditolak</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="<?php echo base_url(); ?>kegiatan/kegiatan" class="small-box-footer">Lebih Lanjut <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
    </div>
</div>
</div><!-- ./col -->
</div>
</section>
</div>