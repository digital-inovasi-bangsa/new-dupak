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

                    <form role="form" id="addButir" action="<?php echo base_url() ?>butir/addNewButir" method="post"
                        role="form">
                        <!-- CSRF Token -->
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="role">Pilih Unsur</label>
                                        <select class="form-control required" id="unsur" name="unsur">
                                            <option value="0">Pilih Unsur</option>
                                            <?php
                                            if(!empty($unsur))
                                            {
                                                foreach ($unsur as $rl)
                                                {
                                                    ?>
                                            <option value="<?php echo $rl->idUnsur ?>"><?php echo $rl->namaUnsur ?>
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
                                        <label for="role">Pilih Subunsur</label>
                                        <select class="form-control required" id="subunsur" name="subunsur">
                                            <option value="0">Pilih Subunsur</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fname">Nama Butir</label>
                                        <input type="text" class="form-control required" id="fbutir" name="fbutir"
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
<script>
$(document).ready(function () {
        // $("#butir-kegiatan").hide();
        $('#unsur').change(function () {
            var idUnsur = $(this).val();
            $.ajax({
                url: "<?php echo base_url();?>butir/getSubunsur",
                method: "POST",
                data: {
                    idUnsur: idUnsur,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                async: false,
                dataType: 'json',
                success: function (data) {
                    var html = '';
                    var i;
                    html += '<option value="' + "0" + '">' + "Pilih subunsur" + '</option>';
                    for (i = 0; i < data.length; i++) {
                        html += '<option value="' + data[i].idSubunsur + '">' + data[i]
                            .namaSubunsur + '</option>';
                    }
                    $('#subunsur').html(html);

                }
            });
        });
    });
</script>