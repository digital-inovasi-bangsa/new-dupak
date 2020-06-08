<?php

$userId = '';
$name = '';
$email = '';
$mobile = '';
$roleId = '';
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
                    <form role="form" action="<?php echo base_url() ?>changePassword" method="post" id="editUser" role="form"
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
                                        <label for="nip">NIP</label>
                                        <input type="text" class="form-control required digits" id="nip" name="nip"
                                            value="<?php echo $nip; ?>">
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
                                        <label for="tempatLahir">Tempat Lahir</label>
                                        <input type="text" class="form-control required" id="tempatLahir"
                                            name="tempatLahir" value="<?php echo $tempatLahir; ?>">
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
        </div>
    </section>
</div>

<script src="<?php echo base_url(); ?>assets/js/editUser.js" type="text/javascript"></script>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/jquery-ui/jquery-ui.min.js" type="text/javascript">
</script>