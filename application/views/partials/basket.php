<h1 class="page-title">Your Cart</h1>
<div style="overflow-x:auto;">
  <div class="rTable">
    <div class="rTableHeading">
      <div class="rTableHead"> Image </div>
      <div class="rTableHead"> Product Name </div>
      <div class="rTableHead"> Model </div>
      <div class="rTableHead"> Quantity </div>
      <div class="rTableHead"> Unit Price </div>
      <div class="rTableHead"> Total </div>
      <div class="rTableHead"> Action </div>
    </div>
    <div class="rTableBody">
      <?php
        if(!empty($cart_data)){
          foreach ($cart_data as $key => $value) {
      ?>
      <div class="rTableRow">
        <div class="rTableCell">
          <a href="<?php echo base_url('product-details/'.$value->prd_slug);?>"><img class="img-thumbnail" title="<?php echo $prd_image[0]->name;?>" alt="<?php echo $prd_image[0]->name;?>" src="<?php echo UPLOAD_PRODUCT_PATH.pathinfo($prd_image[0]->name, PATHINFO_FILENAME).'_s.'.pathinfo($prd_image[0]->name, PATHINFO_EXTENSION);?>"> </a>
        </div>
        <div class="rTableCell"><?php echo $value->prd_name;?></div>
        <div class="rTableCell"> <?php echo $value->prd_slug;?> </div>
        <div class="rTableCell productQuantity">
          <input name="qty" type="text" class="form-control" value="<?php echo $value->prd_count;?>" readonly>
          <span class="input-group-btn">
            <button class="btn btn-primary" title="Increase" onclick="update_cart('increase', '<?php echo $value->cart_id;?>');"><i class="fa fa-plus"></i></button>
            <button class="btn btn-danger" title="Decrease" onclick="update_cart('decrease', '<?php echo $value->cart_id;?>');"><i class="fa fa-minus" aria-hidden="true"></i></button>
          </span> 
        </div>
        <?php
          if((int)$value->prd_discounted_price > 0){
              $unit_price = number_format($value->prd_discounted_price, 2);
              $total_price = number_format($value->prd_discounted_price*$value->prd_count, 2);
          }else{
              $unit_price = number_format($value->prd_price, 2);
              $total_price = number_format($value->prd_price*$value->prd_count, 2);
          }
        ?>
        <div class="rTableCell">          
          <div class="cartPageAmt"><i class="fa fa-inr"></i> <?php echo $unit_price;?></div>
        </div>
        <div class="rTableCell">
          <div class="cartPageAmt"><i class="fa fa-inr"></i> <?php echo $total_price;?></div>
        </div>
        <div class="rTableCell"><button class="btn btn-danger" title="Delete" onclick="update_cart('delete', '<?php echo $value->cart_id;?>');"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button></div>
      </div>
      <?php
        }
      }else{
      ?>
      <div class="rTableRow"><div class="rTableCell">You cart is empty</div></div>
      <?php
      }
      ?>            
    </div>
  </div>
</div>
<div class="continueShopSection">
  <div class="col-sm-6 couponCodeBox"> <span class="success"></span> <span class="error"></span>
    <input id="coupon_code" name="coupon_code" value="<?php echo $this->session->userdata('active_coupon_code');?>" type="text" placeholder="Apply coupons" autocomplete="off">
    <button id="btn-apply-coupon" onclick="applyCoupon();">Apply</button>
    <a href="javascript:void(0)" onclick="cancelCoupon();" class="remove_coupon_cls"><i class="fa fa-search fa-times" aria-hidden="true"></i></a>
    <div class="clearfix"></div>
    <span class="error" id="coupon_err"></span>
  </div>
  <div class="col-sm-6 text-right"> <a class="websiteBtn" href="<?php echo base_url();?>"> Continue Shopping <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a> </div>
  <div class="clearfix"></div>
</div>
<h3>What would you like to do next?</h3>
<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
<div class="row">
  <div class="col-md-5 col-md-offset-7">
    <span id="price_chart">
    <?php echo $price_chart;?>
  </span>
    <div class="pull-right"> <a class="websiteBtn" href="<?php echo base_url("checkout");?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Checkout</a> </div>
  </div>
</div>