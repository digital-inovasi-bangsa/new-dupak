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
      if ($role == 18) {
      ?>
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?php if($kegiatanPegawaiDiterima){
              echo round($kegiatanPegawaiDiterima[0]->jmlPoint);
            } else {
              echo 0;
            }?></h3>
            <p>Jumlah Point Diterima</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="<?php echo base_url(); ?>kegiatan/kegiatan" class="small-box-footer">Lebih Lanjut <i
              class="fa fa-arrow-circle-right"></i></a>
        </div>
          <?php } ?>
      </div><!-- ./col -->
      <?php
      if ($role == 18) {
      ?>
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3><?php if($kegiatanPegawaiDitolak){
              echo round($kegiatanPegawaiDitolak[0]->jmlPoint);
            } else {
              echo 0;
            }?></h3>
            <p>Jumlah Point Ditolak</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="<?php echo base_url(); ?>kegiatan/kegiatan" class="small-box-footer">Lebih Lanjut <i
              class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
          <?php } ?>
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-orange">
          <div class="inner">
            <h3>
              <?php if($kegiatanPegawaiDiterima){
              echo round($kegiatanPegawaiDiterima[0]->jmlKegiatan);
            } else {
              echo 0;
            }?>
            </h3>
            <p>Jumlah Kegiatan Diterima</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="<?php echo base_url(); ?>kegiatan/kegiatan" class="small-box-footer">Lebih Lanjut <i
              class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-purple">
          <div class="inner">
            <h3>
              <?php if($kegiatanPegawaiDitolak){
              echo round($kegiatanPegawaiDitolak[0]->jmlKegiatan);
            } else {
              echo 0;
            }?>
            </h3>
            <p>Jumlah Kegiatan Ditolak</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="<?php echo base_url(); ?>kegiatan/kegiatan" class="small-box-footer">Lebih Lanjut <i
              class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
    </div>
    <div class="row">
      <?php
      if ($role == 1 || $role == 18) {
      ?>
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
          <div class="inner">
            <h3><?php if($jumlahKegiatan > 0){
              echo round($jumlahKegiatan);
            } else {
              echo 0;
            }?></h3>
            <p>Total Kegiatan yang belum Approve</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="<?php echo base_url(); ?>kegiatan/approvalKegiatan" class="small-box-footer">Lebih Lanjut <i
              class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
      <?php
      }
      ?>
      <?php
      if ($role == 1) {
      ?>
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?php echo round($jumlahUser) ?></h3>
            <p>Total Pegawai</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="<?php echo base_url(); ?>user/userListing" class="small-box-footer">Lebih Lanjut <i
              class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
      <?php
      }
      ?>
    </div>
  </section>
</div>