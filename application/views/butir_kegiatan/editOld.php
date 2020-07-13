<?php

$idButirKegiatan = '';
$keterangan = '';
$idButir = '';
$idNamaButir = '';
$point = '';

if (!empty($butirInfo)) {
    foreach ($butirInfo as $uf) {
        $idButir = $uf->idButir;
        $namaButir = $uf->namaButir;
        $idButirKegiatan = $uf->idButirKegiatan;
        $keterangan = $uf->keterangan;
        $point = $uf->point;
    }
}


?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $pageTitle; ?>
            <small></small>
        </h1>
    </section>

    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-warning">
                    <div class="box-header">
                        <h3 class="box-title"><?= $pageTitle; ?></h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" action="<?php echo base_url() ?>butir_kegiatan/editButir" method="post" id="editButir" role="form">
                        <!-- CSRF Token -->
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                <div class="form-group">
                                        <label for="role">Pilih Butir</label>
                                        <select class="form-control" id="idButir" name="idButir">
                                            <option value="0">Pilih Butir</option>
                                            <?php
                                            if (!empty($butir)) {
                                                foreach ($butir as $rl) {
                                            ?>
                                                    <option value="<?php echo $rl->idButir; ?>" <?php if ($rl->idButir == $idButir) {
                                                                                                    echo "selected=selected";
                                                                                                } ?>>
                                                        <?php echo $rl->namaButir ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Butir</label>
                                        <input type="text" class="form-control" id="fbutir" placeholder="Nama Butir" name="fbutir" value="<?php echo $keterangan; ?>" maxlength="128">
                                        <input type="hidden" value="<?php echo $idButirKegiatan; ?>" name="idButirKegiatan" />
                                    </div>
                                    <div class="form-group">
                                        <label for="fname">Point</label>
                                        <input type="text" class="form-control required" id="point" name="point" maxlength="128" value="<?php echo $point; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary pull-right" value="Perbaharui" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                </div><!-- /.box-body -->
                </form>
            </div>
        </div>
</div>
</section>
</div>


<script src="<?php echo base_url(); ?>assets/js/editUser.js" type="text/javascript"></script>
