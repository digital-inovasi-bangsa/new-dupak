<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <?= $pageTitle; ?>
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
                <div class="box box-warning">
                    <div class="box-header">
                        <h3 class="box-title"><?= $pageTitle; ?></h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" id="addBuktiKegiatan" action="<?php echo base_url() ?>kegiatan/addNewBuktiKegiatan" method="post"
                        role="form" enctype="multipart/form-data">
                        <!-- CSRF Token -->
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Surat Perintah (.pdf) *</label>
                                        <input onchange="ValidateSizeSuratPerintah(this)" type="file" required accept="application/pdf" id="surat_perintah" name="surat_perintah">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Dokumentasi (.jpg/.png) *</label>
                                        <input onchange="ValidateSizeDokumentasi(this)" type="file" required accept="image/*" id="dokumentasi" name="dokumentasi">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Laporan Data (.pdf) *</label>
                                        <input onchange="ValidateSizeLaporanData(this)" type="file" required accept="application/pdf" id="laporan_data" name="laporan_data">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Daftar Hadir (.pdf) *</label>
                                        <input onchange="ValidateSizeDaftarHadir(this)" type="file" required accept="application/pdf" id="daftar_hadir" name="daftar_hadir">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Jurnal (.pdf) *</label>
                                        <input onchange="ValidateSizeJurnal(this)" type="file" required accept="application/pdf" id="jurnal" name="jurnal">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Checklist Peralatan (.pdf) *</label>
                                        <input onchange="ValidateSizeChecklist(this)" type="file" required accept="application/pdf" id="checklist_peralatan" name="checklist_peralatan">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Sprint Siaga (.pdf) *</label>
                                        <input onchange="ValidateSizeSprint(this)" type="file" required accept="application/pdf" id="sprint_siaga" name="sprint_siaga">
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary pull-right" value="Simpan" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</div>
<script src="<?php echo base_url(); ?>assets/js/addUser.js" type="text/javascript"></script>
<script>
    function ValidateSizeDokumentasi(file) {
        var FileSize = file.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 10) {
            alert('File maksimal 10 MB');
            $(file).val(''); //for clearing with Jquery
        } else {

        }
        function ValidateSizeSprint(file) {
        var FileSize = file.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 10) {
            alert('File maksimal 10 MB');
            $(file).val(''); //for clearing with Jquery
        } else {

        }
        function ValidateSizeChecklist(file) {
        var FileSize = file.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 10) {
            alert('File maksimal 10 MB');
            $(file).val(''); //for clearing with Jquery
        } else {

        }
        function ValidateSizeJurnal(file) {
        var FileSize = file.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 10) {
            alert('File maksimal 10 MB');
            $(file).val(''); //for clearing with Jquery
        } else {

        }
        function ValidateSizeDaftarHadir(file) {
        var FileSize = file.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 10) {
            alert('File maksimal 10 MB');
            $(file).val(''); //for clearing with Jquery
        } else {

        }
        function ValidateSizeLaporanData(file) {
        var FileSize = file.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 10) {
            alert('File maksimal 10 MB');
            $(file).val(''); //for clearing with Jquery
        } else {

        }
        function ValidateSizeSuratPerintah(file) {
        var FileSize = file.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 10) {
            alert('File maksimal 10 MB');
            $(file).val(''); //for clearing with Jquery
        } else {

        }
    }
</script>