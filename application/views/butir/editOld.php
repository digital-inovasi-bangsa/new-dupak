<?php

$idButir = '';
$namaButir = '';
$idSubunsur = '';
$namaSubunsur = '';

if(!empty($butirInfo))
{
    foreach ($butirInfo as $uf)
    {
        $idButir = $uf->idButir;
        $namaButir = $uf->namaButir;
        $idSubunsur = $uf->idSubunsur;
        $namaSubunsur = $uf->namaSubunsur;
    }
}


?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Master Butir
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
                        <h3 class="box-title">Ubah Data Butir</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" action="<?php echo base_url() ?>butir/editButir" method="post"
                        id="editButir" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nama Butir</label>
                                        <input type="text" class="form-control" id="fbutir"
                                            placeholder="Nama Butir" name="fbutir"
                                            value="<?php echo $namaButir; ?>" maxlength="128">
                                        <input type="hidden" value="<?php echo $idButir; ?>" name="idButir" />
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Pilih Subunsur</label>
                                        <select class="form-control" id="idSubunsur" name="idSubunsur">
                                            <option value="0">Pilih Subunsur</option>
                                            <?php
                                            if(!empty($subunsur))
                                            {
                                                foreach ($subunsur as $rl)
                                                {
                                                    ?>
                                            <option value="<?php echo $rl->idSubunsur; ?>"
                                                <?php if($rl->idSubunsur == $idSubunsur) {echo "selected=selected";} ?>>
                                                <?php echo $rl->namaSubunsur ?></option>
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