<?php

$idDivisi = '';
$namaDivisi = '';

if(!empty($divisiInfo))
{
    foreach ($divisiInfo as $uf)
    {
        $idDivisi = $uf->idDivisi;
        $namaDivisi = $uf->namaDivisi;
    }
}


?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Master Divisi
            <small>Tambah, Ubah, Hapus</small>
        </h1>
    </section>

    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Data Divisi</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <!-- form start -->
                        <form role="form" action="<?php echo base_url() ?>divisi/editDivisi" method="post"
                            id="editDivisi" role="form">
                            <!-- CSRF Token -->
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="fname">Divisi Lengkap</label>
                                            <input type="text" class="form-control" id="fdivisi"
                                                placeholder="Divisi Lengkap" name="fdivisi"
                                                value="<?php echo $namaDivisi; ?>" maxlength="128">
                                            <input type="hidden" value="<?php echo $idDivisi; ?>" name="idDivisi" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <input type="submit" class="btn btn-primary pull-right" value="Submit" />
                        <input type="reset" class="btn btn-default" value="Reset" />
                    </div>
                </div>

                </form>
            </div>
        </div>
</div>
</section>
</div>


<script src="<?php echo base_url(); ?>assets/js/editUser.js" type="text/javascript"></script>