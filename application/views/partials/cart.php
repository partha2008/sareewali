<a href="javascript:void(0);"><i class="fa fa-shopping-cart" aria-hidden="true"></i> My Cart (<?php echo $count;?>)</a>
<ul class="myCartBox">
  <h6 class="subtitle">Recently added item(s) <span class="cartCloe"><i class="fa fa-times-circle" aria-hidden="true"></i></span></h6>
  <?php
    if(!$this->defaultdata->is_user_session_active()){
  ?>
  <p class="cardEmpty">You have no items in your shopping cart.</p>
  <?php
    }else{
  ?>
  <div class="cartAddedBox">
    <div class="cartTotalPrice"> Total : <span><i class="fa fa-inr"></i><?php echo $total_price;?></span> </div>
    <div class="buttons"> 
      <a rel="nofollow" title="View my shopping cart" href="<?php echo base_url("cart");?>" class="websiteBtn">View cart</a> 
      <a rel="nofollow" title="View my shopping cart" href="#" class="websiteBtn" id="button_goto_cart">Checkout</a> 
    </div>
  </div>
  <?php
    }
  ?>
</ul>