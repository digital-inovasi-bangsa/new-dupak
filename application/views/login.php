      <div class="login-box-body">

        <p class="login-box-msg">Silahkan Login Terlebih Dahulu</p>
        <div class="row">
          <?php $this->load->view('includes/_flash'); ?>
        </div>

        <form action="<?php echo base_url(); ?>loginMe" method="POST">
          <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" name="email" required />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password" required />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <a href="<?= base_url() ?>login/forgotpassword">Lupa Kata Sandi ?</a><br>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <input type="submit" class="btn btn-warning btn-block btn-flat" value="Login" />
            </div><!-- /.col -->
          </div>
        </form>

      </div><!-- /.login-box-body -->
