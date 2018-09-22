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

          <h1 class="page-title">My Details</h1>

             

             <div class="row">

              

                <?php 
                  echo $sidebar;
                ?>

                

                <div class="col-md-9">

                  <form id="frmProfile" class="form-horizontal" method="post" action="<?php echo base_url('home/update_account');?>" novalidate>
                    <?php $sess_notify = $this->session->userdata('has_error');
            if(isset($sess_notify) & $sess_notify){?>
              <div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><span class="error"><?php echo $this->session->userdata('myaccount_notification');?></span></div>
           
            <?php } ?>
            <?php if(isset($sess_notify) & !$sess_notify){?>
            <div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><span class="success"><?php echo $this->session->userdata('myaccount_notification');?></span></div>
            <?php } 
              $this->session->unset_userdata('has_error');
              $this->session->unset_userdata('myaccount_notification');            
            ?>

                      

                  

              <fieldset id="account">

                <legend>Your Personal Details</legend>

                

                <div class="form-group required">

                  <label class="col-sm-2 control-label" for="input-firstname">First Name</label>

                  <div class="col-sm-10">

                    <input name="first_name" placeholder="First Name" id="first_name" value="<?php echo $user->first_name;?>" class="form-control" type="text">

                  </div>

                </div>

                <div class="form-group required">

                  <label class="col-sm-2 control-label" for="input-lastname">Last Name</label>

                  <div class="col-sm-10">

                    <input name="last_name" placeholder="Last Name" id="last_name" value="<?php echo $user->last_name;?>" class="form-control" type="text">

                  </div>

                </div>

                <div class="form-group required">

                  <label class="col-sm-2 control-label" for="input-email">E-Mail</label>

                  <div class="col-sm-10">

                    <input name="email" placeholder="E-Mail" id="email" value="<?php echo $user->email;?>" class="form-control" type="email">
                    <input type="hidden" name="old_email" value="<?php echo $user->email;?>">
                  </div>

                </div>

                <div class="form-group required">

                  <label class="col-sm-2 control-label" for="input-telephone">Phone</label>

                  <div class="col-sm-10">

                    <input name="phone" placeholder="Phone" id="phone" value="<?php echo $user->phone;?>" class="form-control" type="tel">
                    <input type="hidden" name="old_phone" value="<?php echo $user->phone;?>">
                  </div>

                </div>

              </fieldset>

              <fieldset id="address">

                <legend>Your Address</legend>

                <div class="form-group required">

                  <label class="col-sm-2 control-label" for="input-address-1">Address 1</label>

                  <div class="col-sm-10">

                    <input name="address1" placeholder="Address 1" id="address1" value="<?php echo $user->address1;?>" class="form-control" type="text">

                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="input-address-2">Address 2</label>

                  <div class="col-sm-10">

                    <input name="address2" placeholder="Address 2" id="address2" value="<?php echo $user->address2;?>" class="form-control" type="text">

                  </div>

                </div>
 
                <div class="form-group required">

                  <label class="col-sm-2 control-label" for="input-city">City</label>

                  <div class="col-sm-10">

                    <input name="city" placeholder="City" id="city" value="<?php echo $user->city;?>" class="form-control" type="text">

                  </div>

                </div>

                <div class="form-group required">

                  <label class="col-sm-2 control-label" for="input-postcode">Post Code</label>

                  <div class="col-sm-10">

                    <input name="post_code" placeholder="Post Code" id="post_code" value="<?php echo $user->post_code;?>" class="form-control" type="text">

                  </div>

                </div>

                <div class="form-group required">

                  <label class="col-sm-2 control-label" for="input-country">Country</label>

                  <div class="col-sm-10">

                    <select name="country_id" id="country" class="form-control">

                      <option value=""> --- Please Select --- </option>

                          <?php
                        if(!empty($country)){
                          foreach($country AS $data){
                        ?>
                        <option value="<?php echo $data->country_id;?>" <?php if($data->country_id == $user->country_id){echo 'selected';}?> ><?php echo $data->name;?></option>
                        <?php
                          }
                        }
                      ?>                  

                                         </select>

                  </div>

                </div>

                <div class="form-group required">

                  <label class="col-sm-2 control-label" for="input-zone">Region / State</label>

                  <div class="col-sm-10">
                    <select name="state_id" id="state" class="form-control">

                      <option value=""> --- Please Select --- </option>
                      <?php
                        if(!empty($states)){
                          foreach ($states as $state) {
                      ?>
                      <option value="<?php echo $state->state_id;?>" <?php if($state->state_id==$user->state_id){echo 'selected';} ?>><?php echo $state->name;?></option>
                      <?php
                          }
                        }
                      ?>
                      
                    </select>

                  </div>

                </div>

                

                 <div class="form-group">

                  <label class="col-sm-2 control-label" for="input-email"></label>

                  <div class="col-sm-10">

                    <button type="submit" id="update-btn" class="websiteBtn">Update</button>

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

