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

                    <form role="form" id="addButirKegiatan" action="<?php echo base_url() ?>butir_kegiatan/addNewButir" method="post"
                        role="form">
                        <!-- CSRF Token -->
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                        <div class="box-body">
                            <div class="row">
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="role">Pilih Butir</label>
                                        <select class="form-control required" id="butir" name="butir">
                                            <option value="0">Pilih Butir</option>
                                            <?php
                                            if(!empty($butir))
                                            {
                                                foreach ($butir as $rl)
                                                {
                                                    ?>
                                            <option value="<?php echo $rl->idButir ?>"><?php echo $rl->namaButir ?>
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
                                        <label for="fname">Nama Butir Kegiatan</label>
                                        <input type="text" class="form-control required" id="keterangan" name="keterangan"
                                            maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fname">Point</label>
                                        <input type="text" class="form-control required" id="point" name="point"
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