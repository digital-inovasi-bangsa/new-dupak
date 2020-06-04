      <div class="login-box-body">
        <p class="login-box-msg">Reset Password</p>
        <?php $this->load->helper('form'); ?>
        <div class="row">
            <div class="col-md-12">
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
            </div>
        </div>
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
        
        <form action="<?php echo base_url(); ?>login/changepassword" method="post">
        <!-- CSRF Token -->
        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="New Password" name="password1" required />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Confirm Password" name="password2" required />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">    
              <!-- <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>  -->                       
            </div><!-- /.col -->
            <div class="col-xs-4">
              <input type="submit" class="btn btn-primary btn-block btn-flat" value="Submit" />
            </div><!-- /.col -->
          </div>
        </form>        
      </div><!-- /.login-box-body -->
    