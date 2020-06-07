<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $pageTitle; ?>
            <small>Masukan sandi baru</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <?php $this->load->view('includes/_flash'); ?>
        </div>
        <div class="row">
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-warning">
                    <div class="box-header">
                        <h3 class="box-title"><?= $pageTitle; ?></h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="<?php echo base_url() ?>changePassword" method="post">
                        <!-- CSRF Token -->
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                        <div class="box-body">
                            <!-- <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="name" class="form-control" id="name" placeholder="Nama Lengkap" value="<?php $userInfo[0]->name ?>" name="name" maxlength="10" required></input>
                                    </div>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputPassword1">Kata Sandi Lama</label>
                                        <input type="password" class="form-control" id="inputOldPassword" placeholder="Kata Sandi Lama" name="oldPassword" maxlength="10" required>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputPassword1">Kata Sandi Baru</label>
                                        <input type="password" class="form-control" id="inputPassword1" placeholder="Kata Sandi Baru" name="newPassword" maxlength="10" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputPassword2">Konfirmasi Kata Sandi Baru</label>
                                        <input type="password" class="form-control" id="inputPassword2" placeholder="Konfirmasi Kata Sandi Baru" name="cNewPassword" maxlength="10" required>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary pull-right" value="Konfirmasi" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>