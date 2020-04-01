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
        $idJabatan = $uf->tbl_jabatan_idJabatan;
    }
}


?>

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
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Tambah Data Pegawai</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="<?php echo base_url() ?>editUser" method="post" id="editUser" role="form"
                        enctype="multipart/form-data">
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
                                        <label for="password">Kata sandi</label>
                                        <input type="password" class="form-control" id="password" placeholder="Password"
                                            name="password" maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpassword">Konfirmasi kata sandi</label>
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
                                            name="mobile" value="<?php echo $mobile; ?>" maxlength="10">
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
                                            maxlength="10" value="<?php echo $nip; ?>">
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="divisi">Jabatan</label>
                                    <select class="form-control required" id="jabatan" name="jabatan">
                                        <option value="0">Pilih Jabatan</option>
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

<script src="<?php echo base_url(); ?>assets/js/editUser.js" type="text/javascript"></script>