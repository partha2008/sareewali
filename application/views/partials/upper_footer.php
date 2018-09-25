<footer class="footer">
  <div class="container">
    <div class="row">
      <?php 
        if(!empty($prd_cat)){
      ?>
      <div class="col-sm-6 col-md-3">
        <div class="footer-title">Product category</div>
        <div class="footer-content">
          <ul class="toggle-footer">
            <?php 
              foreach ($prd_cat as $key => $value) {                
            ?>
            <li><a href="<?php echo base_url('product-list/'. $value->slug);?>"><?php echo $value->name;?></a></li>
            <?php
              }
            ?>
          </ul>
        </div>
      </div>
      <?php
        }
      ?>
      <div class="col-sm-6 col-md-3">

        <div class="footer-title">MY ACCOUNT</div>

        <div class="footer-content">

          <ul class="toggle-footer">
            <?php
            if($this->defaultdata->is_user_session_active() != 1){
            ?>
            <li><a href="javascript:void(0);" onclick="openModal('login');" >Log In</a></li>
            <?php
              }else{ 
            ?>
            <li><a href="<?php echo base_url('myaccount');?>">My Account</a></li>
            <li><a href="javascript:void(0);">My Cart</a></li>
            <li><a href="<?php echo base_url('mywishlist');?>">Wish List</a></li>
            <li><a href="<?php echo base_url('orderhistory');?>">Order History</a></li>
            <?php
              }
            ?>
          </ul>

        </div>

      </div>

      <div class="col-sm-6 col-md-3">

        <div class="footer-title">About Saree wali</div>

        <div class="footer-content">

          <ul class="toggle-footer">

            <li><a href="<?php echo base_url('about');?>">About Us</a></li>
            <li><a href="<?php echo base_url('contact');?>">Contact Us</a></li>
            <li><a href="<?php echo base_url('feedback');?>">Feedback</a></li>
            <li><a href="<?php echo base_url('return');?>">Cancellation & Returns</a></li>
            <li><a href="<?php echo base_url('term');?>">Terms & Conditions</a></li>
            <li><a href="<?php echo base_url('privacy');?>">Privacy Policy</a></li>
            <li><a href="<?php echo base_url('shipping');?>">Shipping Policy</a></li>

          </ul>

        </div>

      </div>

      <div class="col-sm-6 col-md-3">

        <div class="footer-title">contact us</div>

        <?php echo $admin_profile->address;?>

      </div>

    </div>

  </div>

</footer>