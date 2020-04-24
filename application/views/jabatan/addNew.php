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
                <div class="box box-warning">
                    <div class="box-header">
                        <h3 class="box-title"><?= $pageTitle; ?></h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" id="addJabatan" action="<?php echo base_url() ?>jabatan/addNewJabatan" method="post"
                        role="form">
                        <!-- CSRF Token -->
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="role">Pilih Jabatan</label>
                                        <select class="form-control required" id="pangkat" name="pangkat">
                                            <option value="0">Pilih Jabatan</option>
                                            <?php
                                            if(!empty($pangkat))
                                            {
                                                foreach ($pangkat as $rl)
                                                {
                                                    ?>
                                            <option value="<?php echo $rl->idPangkat ?>"><?php echo $rl->namaPangkat ?>
                                            </option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fname">Nama Pangkat</label>
                                        <input type="text" class="form-control required" id="fjabatan" name="fjabatan"
                                            maxlength="128">
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary pull-right" value="Simpan" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</div>
<script src="<?php echo base_url(); ?>assets/js/addJabatan.js" type="text/javascript"></script>