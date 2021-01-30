<?php echo $head; ?>
<?php echo $header; ?>

<section class="breadcrumbs">
  <div class="container">
    <?php echo $breadcrumb;?>
  </div>
</section>

<div id="container" class="row main_wraper product">
  <div id="procontent">
    <div id="notification"></div>
    <div class="product-info bg">
      <div class="product_column column_1"> 
        <div class="app-figure" id="zoom-fig">
          <a id="Zoom-1" class="MagicZoom" title="<?php echo $product->name;?>"
              href="<?php echo UPLOAD_PRODUCT_PATH.pathinfo($product_image[0]->name, PATHINFO_FILENAME).'_xl.'.pathinfo($product_image[0]->name, PATHINFO_EXTENSION);?>"
          >
              <img src="<?php echo UPLOAD_PRODUCT_PATH.pathinfo($product_image[0]->name, PATHINFO_FILENAME).'_xl.'.pathinfo($product_image[0]->name, PATHINFO_EXTENSION);?>" alt=""/>
          </a>
          <div class="selectors" style="margin-top:2px;">
            <?php
              foreach ($product_image as $value) {                
            ?>
             <a
                  data-zoom-id="Zoom-1"
                  href="<?php echo UPLOAD_PRODUCT_PATH.pathinfo($value->name, PATHINFO_FILENAME).'_xl.'.pathinfo($value->name, PATHINFO_EXTENSION);?>"
                  data-image="<?php echo UPLOAD_PRODUCT_PATH.pathinfo($value->name, PATHINFO_FILENAME).'_xl.'.pathinfo($value->name, PATHINFO_EXTENSION);?>"
              >
                  <img style="width:56px;" src="<?php echo UPLOAD_PRODUCT_PATH.pathinfo($value->name, PATHINFO_FILENAME).'_s.'.pathinfo($value->name, PATHINFO_EXTENSION);?>"/>
              </a>
            <?php
              }
            ?>
          </div>
      </div>
        
      </div>
      <div class="product_information">
        <div class="product_column details_boxC">
          <div class="clearall"></div>
          <h1><span><?php echo $product->name;?></span></h1>
          <div class="model_block">SKU: <span><?php echo $product->sku;?> </span></div>
          <div class="time_to_ship"> Availability: Ship in <span> 2 Days </span> </div>         
          <div class="price">
            <div class="pricetitle">Price: </div>
            <?php
              if($product->prd_dic_chk == "Y"){
            ?>
            <span class="old-price"><strike><i class="fa fa-inr"></i><?php echo $product->price;?></strike></span>
            <?php
              }
            ?>
            <?php
              if($product->prd_dic_chk == "Y"){
            ?>
            <span class="price-new updated-price"><i class="fa fa-inr"></i><?php echo $product->discounted_price;?></span>
            <?php
              }else{
            ?>
            <span class="price-new updated-price"><i class="fa fa-inr"></i><?php echo $product->price;?></span>
            <?php
              }
            ?>
            <?php
              if($product->prd_dic_chk == "Y"){
                if($product->prd_dis_mode == "per"){
            ?>
            <span class="price-dis"><?php echo (int)$product->prd_dis_amt;?>% OFF</span>
            <?php
                }elseif($product->prd_dis_mode == "flat"){
            ?>
            <span class="price-dis"><i class="fa fa-inr"></i><?php echo $product->prd_dis_amt;?> OFF</span>
            <?php
                }
              }
            ?>
          </div>
          <?php
            if($product->out_of_stock == 'Y' || $product->quantity == 0){
          ?>
          <p><span>Availability :</span> Out of Stock</p>
          <?php
            }
          ?>
          <div class="clearall"></div>
          <?php
            if($product->mode_qnty == "2" && $product->out_of_stock != 'Y' && $product->quantity != 0){
          ?>
          <div class="me_size_block">Size: <select onchange="checkSize(this, '<?php echo $product->slug;?>', '<?php echo $this->defaultdata->is_user_session_active();?>')"><option value="">Choose Size...</option>
            <?php
              if(!empty($prd_sizes)){
                foreach ($prd_sizes as $key => $value) {
                  if($value->quantity == "0"){
            ?>
              <option value="<?php echo $value->size; ?>" key="out"><?php echo $value->size. ' (Out of Stock)'; ?></option>
            <?php
                  }else{
            ?>
            <option value="<?php echo $value->size; ?>" key="in"><?php echo $value->size; ?></option>
            <?php
                  }
                }
              }
            ?>
          </select>
          <a data-toggle="modal" data-target="#how_to_measure_tbl" href="javascript:void(0);" title="How To Measure" class="inline_auto_measure chart cboxElement"> <i class="fa fa-crop"></i> How To Measure</a> 
          <a data-toggle="modal" data-target="#size_chart_tbl" href="javascript:void(0);" title="Size Chart" class="inline_auto chart cboxElement"> <i class="fa fa-bar-chart"></i> Size Chart</a> 
        </div>
        <span id="select_size_warn" class="select-size-warn">Please select size</span>
          <?php
            }
          ?>
        </div>
        <div class="product_column details_box" style="display:none;"> </div>
        <div class="product_column details_box">           
          <div class="more_details right">
            <h3>Product Highlights</h3>
            <div class="description comment more show-read-more">
              <?php echo $product->description;?>
            </div>
          </div>
        </div>
      </div>
      <div class="product_column_right">
        <div class="prorightcart">
          <span id="add-to-cart-block">
          <?php
            if($product->out_of_stock == 'N' && $product->quantity > 0){
          ?>
          <div class="addtocartbuttonholder"> 
            <a class="add_to_cart_button quick_cart" onclick="addToCart('<?php echo $product->slug;?>', '<?php echo $this->defaultdata->is_user_session_active();?>', 'false', '<?php echo $product->mode_qnty;?>');" title="Add to Cart" href="javascript:void(0);">
              <div class="add_cart_block ">Add to Cart</div>
            </a>
          </div>
          <a onclick="addToCart('<?php echo $product->slug;?>', '<?php echo $this->defaultdata->is_user_session_active();?>', 'true', '<?php echo $product->mode_qnty;?>');" title="Buy Now" class="button quick_buy_button ">Buy Now</a> 
          <?php
            }else{
          ?>
          <span class="button out-of-stock_button">out of stock</span> 
          <?php
            }
          ?>
        </span>
          <span class="add_links">           
          <a onclick="addToWishList('<?php echo $product->product_id;?>', '<?php echo $this->defaultdata->is_user_session_active();?>');" title="Add to Wish List" class="add_to_wishlist"> <i class="fa fa-heart-o" aria-hidden="true"></i> Add to Wishlist</a> <!-- <a href="#tab-inquire" class="inquire_now inline_inquire cboxElement" title="Inquire for 7547"> <i class="fa fa-envelope-o" aria-hidden="true"></i> Inquire Now </a> --> </span>
          <div class="clearall"></div>
          
          <div class="clearfix"></div>
            <div class="codBox"> <span>Check COD available</span>
              <input id="pin_code" name="pin_code" type="text" placeholder="Enter Pincode">
              <button id="btn-pin" onClick="checkAvailability();">Check</button>
              <small class="text-success" id="txt_avl"></small>
            </div>
            <div class="clearfix"></div>
          <div class="order_by_phone">
            <div class="ortitle"> Place Order By Phone / Whatsapp : </div>
            <span class="callord"> <i class="fa fa-phone"></i> <?php echo $admin_profile->contact_no;?></span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php echo $product_details_tab;?>
</div>

<div class="container detailsPage">  
  <?php echo $more_collections;?>

  <?php echo $best_selling_products;?>

</div>
 

  <?php echo $review_modal;?>
      
<?php echo $footer; ?>
<?php echo $foot; ?>
<?php
  if($product->mode_qnty == "2" && $product->out_of_stock != 'Y' && $product->quantity != 0){
    echo $how_to_measure;
    echo $size_chart;
  }
  ?>