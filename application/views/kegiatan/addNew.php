<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Kegiatan
            <small>Tambah, Ubah, Hapus</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <?php $this->load->view('includes/_flash'); ?>
        </div>
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Tambahkan Data Kegiatan</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" id="addUser" action="<?php echo base_url() ?>kegiatan/addNewKegiatan"
                        method="post" role="form">
                        <!-- CSRF Token -->
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="divisi">Jenjang</label>
                                        <select class="form-control required" id="jenjang" name="jenjang">
                                            <option value="0">Pilih Jenjang</option>
                                            <?php
                                            if(!empty($jenjang))
                                            {
                                                foreach ($jenjang as $rl)
                                                {
                                                    ?>
                                            <option value="<?php echo $rl->idJenjang ?>"><?php echo $rl->namaJenjang ?>
                                            </option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="unsur">Unsur</label>
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
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="subunsur">Subunsur</label>
                                        <select class="form-control required" id="subunsur" name="subunsur">
                                            <option value="0" selected disabled hidden>Pilih subunsur</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="butir">Butir</label>
                                        <select class="form-control required" id="butir" name="butir">
                                            <option value="0">Pilih Butir</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row" name="butir-kegiatan" id="butir-kegiatan">
                                <div class="col-md-12">
                                    <label for="butir_kegiatan">Butir Kegiatan</label>
                                    <div class="form-group">
                                        <div class="checkbox" style="margin-left: 20px" id="checkbox-butir">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" name="tanggal" id="tanggal">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tanggal Mulai</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="tanggalMulai"
                                                name="tanggalMulai">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                            </div>
                            <div class="row" name="tanggal" id="tanggal">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tanggal Selesai</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="tanggalSelesai"
                                                name="tanggalSelesai">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary pull-right" value="Submit" />
                            <input type="reset" class="btn btn-default pull-right" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</div>
<script src="<?php echo base_url(); ?>assets/js/addUser.js" type="text/javascript"></script>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/jquery-ui/jquery-ui.min.js" type="text/javascript">
</script>
<script
    src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
</script>
<script>
    $(document).ready(function () {
        $("#butir-kegiatan").hide();
        $('#unsur').change(function () {
            var idUnsur = $(this).val();
            $.ajax({
                url: "<?php echo base_url();?>kegiatan/getSubunsur",
                method: "POST",
                data: {
                    idUnsur: idUnsur
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
    $(document).ready(function () {
        $('#butir').change(function () {
            var idButir = $(this).val();
            console.log(idButir);
            $.ajax({
                url: "<?php echo base_url();?>kegiatan/getButirKegiatan",
                method: "POST",
                data: {
                    idButir: idButir
                },
                async: false,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<input type="checkbox" name="businessType[]" value="' +
                            data[i].idButirKegiatan + '">' + data[i]
                            .keterangan  + '</input>' + ' ' + '<span class="label" style="background-color:green">' + '+' +data[i].point +'</span>' + '<br>';
                    }
                    $('#checkbox-butir').html(html);
                    $("#butir-kegiatan").show();
                }
            });
        });
    });
    $(document).ready(function () {
        $('#subunsur').change(function () {
            var idSubunsur = $(this).val();
            console.log(idSubunsur);
            $.ajax({
                url: "<?php echo base_url();?>kegiatan/getButir",
                method: "POST",
                data: {
                    idSubunsur: idSubunsur
                },
                async: false,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    var html = '';
                    var i;
                    html += '<option value="' + "0" + '">' + "Pilih butir" + '</option>';
                    for (i = 0; i < data.length; i++) {
                        html += '<option value="' + data[i].idButir + '">' + data[i]
                            .namaButir + '</option>';
                    }
                    $('#butir').html(html);

                }
            });
        });
    });
</script>

<script>
    $('#tanggalMulai').datepicker({
        autoclose: true
    })
    $('#tanggalSelesai').datepicker({
        autoclose: true
    })
</script>