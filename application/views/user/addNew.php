<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Master Pegawai
            <small>Tambah, Ubah, Hapus</small>
        </h1>
    </section>
    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Masukan Data Pegawai</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" id="addUser" action="<?php echo base_url() ?>addNewUser" method="post" role="form"
                        enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fname">Nama Lengkap</label>
                                        <input type="text" class="form-control required" id="fname" name="fname"
                                            maxlength="128">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control required email" id="email" name="email"
                                            maxlength="128">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Kata sandi <small>(Maks.10 Karakter)</small></label>
                                        <input type="password" class="form-control required" id="password"
                                            name="password" maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpassword">Konfirmasi kata sandi <small>(Maks.10
                                                Karakter)</small></label>
                                        <input type="password" class="form-control required equalTo" id="cpassword"
                                            name="cpassword" maxlength="10">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Nomer Telepon</label>
                                        <input type="text" class="form-control required digits" id="mobile"
                                            name="mobile">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select class="form-control required" id="role" name="role">
                                            <option value="0">Pilih Role</option>
                                            <?php
                                            if(!empty($roles))
                                            {
                                                foreach ($roles as $rl)
                                                {
                                                    ?>
                                            <option value="<?php echo $rl->roleId ?>"><?php echo $rl->role ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nip">NIP</label>
                                        <input type="text" class="form-control required digits" id="nip" name="nip">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="divisi">Divisi</label>
                                        <select class="form-control required" id="divisi" name="divisi">
                                            <option value="0">Pilih Divisi</option>
                                            <?php
                                            if(!empty($divisi))
                                            {
                                                foreach ($divisi as $rl)
                                                {
                                                    ?>
                                            <option value="<?php echo $rl->idDivisi ?>"><?php echo $rl->namaDivisi ?>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="divisi">Jabatan</label>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="divisi">Pangkat</label>
                                        <select class="form-control required" id="jabatan" name="jabatan">
                                            <option value="0">Pilih Pangkat</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mulai Kerja</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="date" class="form-control pull-right" id="mulaiKerja"
                                                name="mulaiKerja">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nomorSeri">Nomor Seri Kartu Pegawai</label>
                                        <input type="text" class="form-control required" id="nomorSeriKartuPegawai"
                                            name="nomorSeriKartuPegawai">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="date" class="form-control pull-right" id="tanggalLahir"
                                                name="tanggalLahir">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tempatLahir">Tempat Lahir</label>
                                        <input type="text" class="form-control required" id="tempatLahir"
                                            name="tempatLahir">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select class="form-control required" id="jenisKelamin" name="jenisKelamin">
                                            <option value="0">Pilih Jenis Kelamin</option>
                                            <option value="laki-laki">Laki-laki</option>
                                            <option value="perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Pendidikan Terakhir</label>
                                    <select class="form-control required" id="pendidikan" name="pendidikan">
                                        <option value="0">Pilih Pendidikan Terakhir</option>
                                        <option value="SD">SD</option>
                                        <option value="SMP">SMP</option>
                                        <option value="SMA">SMK/SMA</option>
                                        <option value="D1">D1</option>
                                        <option value="D2">D2</option>
                                        <option value="D3">D3</option>
                                        <option value="S1">S1/D4</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Foto Profil</label>
                                        <input type="file" id="image" name="user_img_upload">
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>

                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
<script src="<?php echo base_url(); ?>assets/js/addUser.js" type="text/javascript"></script>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/jquery-ui/jquery-ui.min.js" type="text/javascript">
</script>
<script>
    $(document).ready(function () {
        $('#pangkat').change(function () {
            var idPangkat = $(this).val();
            $.ajax({
                url: "<?php echo base_url();?>user/callJabatan",
                method: "POST",
                data: {
                    idPangkat: idPangkat
                },
                async: false,
                dataType: 'json',
                success: function (data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value="' + data[i].idJabatan + '">' + data[i]
                            .namaJabatan + '</option>';
                    }
                    $('#jabatan').html(html);

                }
            });
        });
    });
</script>