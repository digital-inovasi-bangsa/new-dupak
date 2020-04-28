<?php

$idButir = '';
$namaButir = '';
$idSubunsur = '';
$namaSubunsur = '';
$idUnsur = '';
$namaUnsur = '';

if (!empty($butirInfo)) {
    foreach ($butirInfo as $uf) {
        $idButir = $uf->idButir;
        $namaButir = $uf->namaButir;
        $idSubunsur = $uf->idSubunsur;
        $namaSubunsur = $uf->namaSubunsur;
        $idUnsur = $uf->idUnsur;
        $namaUnsur = $uf->namaUnsur;
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

                    <form role="form" action="<?php echo base_url() ?>butir/editButir" method="post" id="editButir"
                        role="form">
                        <!-- CSRF Token -->
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                            value="<?= $this->security->get_csrf_hash(); ?>" />
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="role">Pilih Unsur</label>
                                        <select class="form-control" id="unsur" name="unsur">
                                            <option value="0">Pilih Unsur</option>
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
                                        <label for="role">Pilih Subunsur</label>
                                        <select class="form-control" id="idSubunsur" name="idSubunsur">
                                            <option value="0">Pilih Subunsur</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Butir</label>
                                        <input type="text" class="form-control" id="fbutir" placeholder="Nama Butir"
                                            name="fbutir" value="<?php echo $namaButir; ?>" maxlength="128">
                                        <input type="hidden" value="<?php echo $idButir; ?>" name="idButir" />
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
<script>
    $(document).ready(function () {
        var idUnsur = $('#unsur :selected').val();
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
                        value = <?php echo $idSubunsur ?>;
                        if(parseInt(data[i].idSubunsur) === parseInt(value) ){
                        html += '<option value="' + data[i].idSubunsur + '" selected=selected>' + data[i]
                             .namaSubunsur + '</option>';
                        } else {
                            html += '<option value="' + data[i].idSubunsur + '"' + '>' + data[i]
                            .namaSubunsur + '</option>';
                        }
                    }
                    $('#idSubunsur').html(html);
                }
            });
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
                    $('#idSubunsur').html(html);

                }
            });
        });
    });
</script>