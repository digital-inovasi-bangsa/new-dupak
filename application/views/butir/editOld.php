<?php

$idButir = '';
$namaButir = '';
$idSubunsur = '';
$namaSubunsur = '';

if (!empty($butirInfo)) {
    foreach ($butirInfo as $uf) {
        $idButir = $uf->idButir;
        $namaButir = $uf->namaButir;
        $idSubunsur = $uf->idSubunsur;
        $namaSubunsur = $uf->namaSubunsur;
    }
}


?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $pageTitle; ?>
            <small>Tambah, Ubah, Hapus</small>
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

                    <form role="form" action="<?php echo base_url() ?>butir/editButir" method="post" id="editButir" role="form">
                        <!-- CSRF Token -->
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nama Butir</label>
                                        <input type="text" class="form-control" id="fbutir" placeholder="Nama Butir" name="fbutir" value="<?php echo $namaButir; ?>" maxlength="128">
                                        <input type="hidden" value="<?php echo $idButir; ?>" name="idButir" />
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Pilih Subunsur</label>
                                        <select class="form-control" id="idSubunsur" name="idSubunsur">
                                            <option value="0">Pilih Subunsur</option>
                                            <?php
                                            if (!empty($subunsur)) {
                                                foreach ($subunsur as $rl) {
                                            ?>
                                                    <option value="<?php echo $rl->idSubunsur; ?>" <?php if ($rl->idSubunsur == $idSubunsur) {
                                                                                                        echo "selected=selected";
                                                                                                    } ?>>
                                                        <?php echo $rl->namaSubunsur ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
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