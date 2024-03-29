<?php

$idSubunsur = '';
$namaSubunsur = '';
$idUnsur = '';


if (!empty($subunsurInfo)) {
    foreach ($subunsurInfo as $uf) {
        $idSubunsur = $uf->idSubunsur;
        $namaSubunsur = $uf->namaSubunsur;
        $idUnsur = $uf->idUnsur;
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

                    <form role="form" action="<?php echo base_url() ?>subunsur/editSubunsur" method="post" id="editSubunsur" role="form">
                        <!-- CSRF Token -->
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="role">Pilih Unsur</label>
                                        <select class="form-control" id="idUnsur" name="idUnsur">
                                            <option value="0">Pilih unsur</option>
                                            <?php
                                            if (!empty($unsur)) {
                                                foreach ($unsur as $rl) {
                                            ?>
                                                    <option value="<?php echo $rl->idUnsur; ?>" <?php if ($rl->idUnsur == $idUnsur) {
                                                                                                    echo "selected=selected";
                                                                                                } ?>>
                                                        <?php echo $rl->namaUnsur ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="fname">Sub Unsur</label>
                                        <input type="text" class="form-control" id="fsubunsur" placeholder="Unsur Lengkap" name="fsubunsur" value="<?php echo $namaSubunsur; ?>" maxlength="128">
                                        <input type="hidden" value="<?php echo $idSubunsur; ?>" name="idSubunsur" />
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
