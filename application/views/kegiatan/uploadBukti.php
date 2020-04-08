<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Kegiatan Harian
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
                        <h3 class="box-title">Upload Bukti Kegiatan</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" id="addBuktiKegiatan" action="<?php echo base_url() ?>kegiatan/addNewBuktiKegiatan" method="post"
                        role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Surat Perintah</label>
                                        <input type="file" id="surat_perintah" name="surat_perintah">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Dokumentasi</label>
                                        <input type="file" id="dokumentasi" name="dokumentasi">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Laporan Data</label>
                                        <input type="file" id="laporan_data" name="laporan_data">
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