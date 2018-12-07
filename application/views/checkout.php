<?php echo $head; ?>
<?php echo $header; ?>

<section class="breadcrumbs">
  <div class="container">
    <?php echo $breadcrumb;?>
  </div>
</section>
<section class="page-container">

  <div class="container detailsPage">

    

       <div class="page-content">

          <h1 class="page-title">Checkout</h1>

 



          <form class="form-horizontal" id="frmSignup">

                   <span class="error"></span>

          <span class="success"></span>

            

            <div class="register-main-block clearfix">
                <div class="row">
                    <div class="col-sm-6 clearfix">
                        <fieldset id="account">
                        <legend>Your Personal Details</legend>
                        <div class="form-group required">
                          <label for="input-firstname" class="col-sm-2 control-label">First Name</label>
                          <div class="col-sm-12">
                            <input type="text" class="form-control" placeholder="First Name" value="<?php echo $user->first_name;?>" name="first_name">
                          </div>
                        </div>
                        <div class="form-group required">
                          <label for="input-lastname" class="col-sm-2 control-label">Last Name</label>
                          <div class="col-sm-12">
                            <input type="text" class="form-control" placeholder="Last Name" value="<?php echo $user->last_name;?>" name="last_name">
                          </div>
                        </div>

                        <div class="form-group required">

                          <label for="input-email" class="col-sm-2 control-label">E-Mail</label>

                          <div class="col-sm-12">

                            <input type="email" class="form-control" placeholder="E-Mail" value="<?php echo $user->email;?>" name="email">

                          </div>

                        </div>

                        <div class="form-group required">

                          <label for="input-telephone" class="col-sm-2 control-label">Telephone</label>

                          <div class="col-sm-12">

                            <input type="tel" class="form-control" placeholder="Telephone" value="<?php echo $user->phone;?>" name="phone">

                          </div>

                        </div>

                      </fieldset>

                    </div>

                        

                    <div class="col-sm-6 clearfix">

                        <fieldset id="address">

                        <legend>Shipping Address</legend>

                        <div class="form-group required">

                          <label for="input-address-1" class="col-sm-2 control-label">Address 1</label>

                          <div class="col-sm-12">

                            <input type="text" class="form-control" placeholder="Address 1" value="<?php echo $user->address1;?>" name="address1">

                          </div>

                        </div>

                        <div class="form-group">

                          <label for="input-address-2" class="col-sm-2 control-label">Address 2</label>

                          <div class="col-sm-12">

                            <input type="text" class="form-control" placeholder="Address 2" value="<?php echo $user->address2;?>" name="address2">

                          </div>

                        </div>

                        <div class="form-group required">

                          <label for="input-city" class="col-sm-2 control-label">City</label>

                          <div class="col-sm-12">

                            <input type="text" class="form-control" placeholder="City" value="<?php echo $user->city;?>" name="city">

                          </div>

                        </div>

                        <div class="form-group required">

                          <label for="input-postcode" class="col-sm-2 control-label">Post Code</label>

                          <div class="col-sm-12">

                            <input type="text" class="form-control" placeholder="Post Code" value="<?php echo $user->post_code;?>" name="post_code">

                          </div>

                        </div>

        

                        <div class="form-group required">

                          <label for="input-country" class="col-sm-2 control-label">Country</label>

                          <div class="col-sm-12">

                            <select class="form-control" name="country_id" onchange="populateStateByCountry(this.value);">

                              <option value=""> --- Please Select --- </option>
                              <?php 
                              if(!empty($country)){
                                  foreach ($country as $key => $value) {
                                    if($value->country_id == $user->country_id){
                                      echo '<option selected value="'.$value->country_id.'">'.$value->name.'</option>';
                                    }else{
                                      echo '<option value="'.$value->country_id.'">'.$value->name.'</option>';
                                    }
                                  }
                              }
                              ?>                   
                            </select>

                          </div>

                        </div>

                        <div class="form-group required">

                          <label for="input-zone" class="col-sm-2 control-label">Region / State</label>

                          <div class="col-sm-12">
                            <select class="form-control" name="state_id" id="state">
                            </select>

                          </div>

                        </div>

                      </fieldset>

                    </div>

                </div>  

      

                  <div class="register-bottom-block clearfix">

                    <div class="col-sm-6">

                        <div class="couponCodeBox"> 

                          <span class="success"></span> <span class="error"></span>

                          <input id="coupon_code" name="coupon_code" value="" type="text" placeholder="Apply coupons">

                          <button id="btn-apply-coupon">Apply</button>

                          <div class="clearfix"></div>

                        </div>

            

                        <div class="rTable itemTotaleBox">

                            <div class="rTableBody">

                              <div class="rTableRow subTotalRow">

                                <div class="rTableCell"> Sub-Total </div>

                                <div class="rTableCell text-right"> <span><i class="fa fa-inr"></i> <?php echo $sub_total;?></span> </div>

                              </div>

                              <div class="rTableRow grandTotatlRow">

                                <div class="rTableCell"> Grand Total </div>

                                <div class="rTableCell text-right"> <span><i class="fa fa-inr"></i> <?php echo $grand_total;?></span> </div>

                              </div>

                            </div>

                          </div>

                  </div>

                    <div class="col-sm-6">
                        <h2 class="title"> Payment with </h2>
                        <p class="enteEmailTxt">Please select the payment type</p>
                        <ul class="productOption">
                            <li>
                                <input type="radio" name="payment_type" value="cod" checked="">
                                <label for="blouseFabri"> <span></span>Cash on Delivery</label>
                            </li>
                            <li>
                                <input type="radio" name="payment_type" value="online">
                                <label for="customTailoring"> <span></span>CCAvenue</label>
                            </li>
                        </ul>
                        <div class="pull-right">
                          <button class="websiteBtn" type="submit"><i class="fa fa-sign-in" aria-hidden="true"></i> Place Order</button>
                        </div>
                    </div>
                   </div>    
             </div>
            </form>

           <div class="clearfix"></div>

        </div>  

        

  </div>

</section>

<?php echo $footer; ?>
<?php echo $foot; ?>
<script>
  var country_id = '<?php echo $user->country_id;?>';
  populateStateByCountry(country_id);
</script>

