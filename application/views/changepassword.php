      <?php echo $head; ?>
      <?php echo $header; ?>

      <section class="breadcrumbs">

        <div class="container">
          <?php echo $breadcrumb;?>
        </div>

      </section>

      <section class="page-container">

  <div class="container checkoutPage">

    

       <div class="page-content">

          <h1 class="page-title">Change Password</h1>

             

             <div class="row">

              

                <?php 
                  echo $sidebar;
                ?>

                

                <div class="col-md-9">

                  <form id="changePWD" class="form-horizontal" method="post" action="<?php echo base_url('home/update_password');?>">
                    <?php $sess_notify = $this->session->userdata('has_error');
            if(isset($sess_notify) & $sess_notify){?>
              <div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><span class="error"><?php echo $this->session->userdata('password_notification');?></span></div>
           
            <?php } ?>
            <?php if(isset($sess_notify) & !$sess_notify){?>
            <div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><span class="success"><?php echo $this->session->userdata('password_notification');?></span></div>
            <?php } 
              $this->session->unset_userdata('has_error');
              $this->session->unset_userdata('password_notification');            
            ?>

                    <fieldset id="account">

                      <div class="form-group required">

                        <label class="col-md-4 control-label" for="input-lastname">New Password</label>

                        <div class="col-md-8">

                          <input name="password" placeholder="New Password" id="new_password" class="form-control" type="password">

                        </div>

                      </div>

                      <div class="form-group required">

                        <label class="col-md-4 control-label" for="input-email">Confirm Password</label>

                        <div class="col-md-8">

                          <input name="confirm_password" placeholder="Confirm Password" id="cnf_password" class="form-control" type="password">

                        </div>

                      </div>

                      <div class="form-group">

                        <label class="col-md-4 control-label" for="input-email"></label>

                        <div class="col-md-8">

                          <button type="submit" id="change-pwd-btn" class="websiteBtn">Update</button>

                        </div>

                      </div>

                    </fieldset>

                  </form>

                </div>



                

             </div>

             <div class="clearfix"></div>

          </div>

        </div>  

</section>
    <?php echo $footer; ?>
    <?php echo $foot; ?>

