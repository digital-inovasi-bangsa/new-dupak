<?php

$userId = '';
$name = '';
$email = '';
$mobile = '';
$roleId = '';
$idDivisi = '';
$namaDivisi = '';
$nip = '';
$idJabatan = '';
$nomorSeriKartuPegawai = '';
$mulaiKerja = '';
$jenisKelamin = '';
$pendidikan = '';
$tanggalLahir = '';
$tempatLahir = '';
if(!empty($userInfo))
{
    foreach ($userInfo as $uf)
    {
        $userId = $uf->userId;
        $name = $uf->name;
        $email = $uf->email;
        $mobile = $uf->mobile;
        $roleId = $uf->roleId;
        $idDivisi = $uf->tbl_divisi_idDivisi;
        $fotoProfil = $uf->fotoProfil;
        $nip = $uf->nip;
        $idJabatan = $uf->idJabatan;
        $namaJabatan = $uf->namaJabatan;
        $idPangkat = $uf->idPangkat;
        $namaPangkat = $uf->namaPangkat;
        $nomorSeriKartuPegawai = $uf->nomorSeriKartuPegawai;
        $mulaiKerja = $uf->mulaiKerja;
        $jenisKelamin = $uf->jenisKelamin;
        $pendidikan = $uf->pendidikan;
        $tanggalLahir = $uf->tanggalLahir;
        $tempatLahir = $uf->tempatLahir;
    }
}


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
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
                    <form role="form" action="<?php echo base_url() ?>editUser" method="post" id="editUser" role="form"
                        enctype="multipart/form-data">
                        <!-- CSRF Token -->
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fname">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="fname" placeholder="Full Name"
                                            name="fname" value="<?php echo $name; ?>" maxlength="128">
                                        <input type="hidden" value="<?php echo $userId; ?>" name="userId" />
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="Enter email"
                                            name="email" value="<?php echo $email; ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Kata sandi <small>(Maks.8 Karakter)</small></label>
                                        <input type="password" class="form-control" id="password" placeholder="Password"
                                            name="password" maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpassword">Konfirmasi kata sandi <small>(Maks.8
                                                Karakter)</small></label>
                                        <input type="password" class="form-control" id="cpassword"
                                            placeholder="Confirm Password" name="cpassword" maxlength="10">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Nomor Telepon</label>
                                        <input type="text" class="form-control" id="mobile" placeholder="Mobile Number"
                                            name="mobile" value="<?php echo $mobile; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select class="form-control" id="role" name="role">
                                            <option value="0">Pilih Role</option>
                                            <?php
                                            if(!empty($roles))
                                            {
                                                foreach ($roles as $rl)
                                                {
                                                    ?>
                                            <option value="<?php echo $rl->roleId; ?>"
                                                <?php if($rl->roleId == $roleId) {echo "selected=selected";} ?>>
                                                <?php echo $rl->role ?></option>
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
                                        <input type="text" class="form-control required digits" id="nip" name="nip"
                                            value="<?php echo $nip; ?>">
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
                                            <option value="<?php echo $rl->idDivisi; ?>"
                                                <?php if($rl->idDivisi == $idDivisi) {echo "selected=selected";} ?>>
                                                <?php echo $rl->namaDivisi ?></option>
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
                                            <option value="<?php echo $rl->idPangkat; ?>"
                                                <?php if($rl->idPangkat == $idPangkat) {echo "selected=selected";} ?>>
                                                <?php echo $rl->namaPangkat ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jabatan">Pangkat</label>
                                        <select class="form-control required" id="jabatan" name="jabatan">
                                            <option value="0">Pilih Pangkat</option>
                                            <?php
                                            if(!empty($jabatan))
                                            {
                                                foreach ($jabatan as $rl)
                                                {
                                                    ?>
                                            <option value="<?php echo $rl->idJabatan; ?>"
                                                <?php if($rl->idJabatan == $idJabatan) {echo "selected=selected";} ?>>
                                                <?php echo $rl->namaJabatan ?></option>
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
                                        <label>Mulai Kerja</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="date" class="form-control pull-right" id="mulaiKerja"
                                                name="mulaiKerja" value="<?php echo $mulaiKerja; ?>">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nomorSeri">Nomor Seri Kartu Pegawai</label>
                                        <input type="text" class="form-control required" id="nomorSeriKartuPegawai"
                                            name="nomorSeriKartuPegawai" value="<?php echo $nomorSeriKartuPegawai; ?>">
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
                                                name="tanggalLahir" value="<?php echo $tanggalLahir; ?>">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tempatLahir">Tempat Lahir</label>
                                        <input type="text" class="form-control required" id="tempatLahir"
                                            name="tempatLahir" value="<?php echo $tempatLahir; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select class="form-control required" id="jenisKelamin" name="jenisKelamin">
                                            <option>Pilih Jenis Kelamin</option>
                                            <option
                                                <?php if ($jenisKelamin=="laki-laki"){echo "selected=selected";} ?>value="laki-laki">
                                                Laki-laki</option>
                                            <option <?php if($jenisKelamin=="perempuan"){echo "selected=selected";} ?>
                                                value="perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Pendidikan Terakhir</label>
                                    <select class="form-control required" id="pendidikan" name="pendidikan">
                                        <option value="0">Pilih Pendidikan Terakhir</option>
                                        <option <?php if ($pendidikan=="SD"){echo "selected=selected";}?> value="SD">SD</option>
                                        <option <?php if ($pendidikan=="SMP"){echo "selected=selected";}?> value="SMP">SMP</option>
                                        <option <?php if ($pendidikan=="SMA"){echo "selected=selected";}?> value="SMA">SMK/SMA</option>
                                        <option <?php if ($pendidikan=="D1"){echo "selected=selected";}?> value="D1">D1</option>
                                        <option <?php if ($pendidikan=="D2"){echo "selected=selected";}?> value="D2">D2</option>
                                        <option <?php if ($pendidikan=="D3"){echo "selected=selected";}?> value="D3">D3</option>
                                        <option <?php if ($pendidikan=="S1"){echo "selected=selected";}?> value="S1">S1/D4</option>
                                        <option <?php if ($pendidikan=="S2"){echo "selected=selected";}?> value="S2">S2</option>
                                        <option <?php if ($pendidikan=="S3"){echo "selected=selected";}?>  value="S3">S3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div><?php if($fotoProfil!=null){ ?>
                                            <img width="100px"
                                                src="<?php echo base_url()."/upload/images/".$fotoProfil?>"></img>
                                            <input type="file" id="image" name="user_img_upload"
                                                style="margin-top: 8px">
                                        </div><?php  } ?>
                                        <div><?php if($fotoProfil==null){ ?>
                                            <label for="text">Foto Profil</label>
                                            <input type="file" id="image" name="user_img_upload">
                                        </div><?php  } ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary pull-right" value="Perbaharui" />
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

<script src="<?php echo base_url(); ?>assets/js/editUser.js" type="text/javascript"></script>
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