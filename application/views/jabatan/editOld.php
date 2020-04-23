<?php

$idJabatan = '';
$namaJabatan = '';
$idPangkat = '';
$namaPangkat = '';

if(!empty($jabatanInfo))
{
    foreach ($jabatanInfo as $uf)
    {
        $idJabatan = $uf->idJabatan;
        $namaJabatan = $uf->namaJabatan;
        $idPangkat = $uf->tbl_pangkat_idPangkat;
        $namaPangkat = $uf->namaPangkat;
    }
}


?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Master Pangkat
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
                        <h3 class="box-title">Ubah Data Pangkat</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" action="<?php echo base_url() ?>jabatan/editJabatan" method="post"
                        id="editJabatan" role="form">
                        <!-- CSRF Token -->
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fname">Pangkat Lengkap</label>
                                        <input type="text" class="form-control" id="fjabatan"
                                            placeholder="Pangkat Lengkap" name="fjabatan"
                                            value="<?php echo $namaJabatan; ?>" maxlength="128">
                                        <input type="hidden" value="<?php echo $idJabatan; ?>" name="idJabatan" />
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Pilih Jabatan</label>
                                        <select class="form-control" id="idPangkat" name="idPangkat">
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