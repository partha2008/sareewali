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
          </select><a data-toggle="modal" data-target="#how_to_measure_tbl" href="javascript:void(0);" title="How To Measure" class="inline_auto_measure chart cboxElement"> <i class="fa fa-crop"></i> How To Measure</a> <a data-toggle="modal" data-target="#size_chart_tbl" href="javascript:void(0);" title="Size Chart" class="inline_auto chart cboxElement"> <i class="fa fa-bar-chart"></i> Size Chart</a> 
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
            <a class="add_to_cart_button quick_cart" onclick="addToCart('<?php echo $product->slug;?>', '<?php echo $this->defaultdata->is_user_session_active();?>', false, '<?php echo $product->mode_qnty;?>');" title="Add to Cart" href="javascript:void(0);">
              <div class="add_cart_block ">Add to Cart</div>
            </a>
          </div>
          <a onclick="addToCart('<?php echo $product->slug;?>', '<?php echo $this->defaultdata->is_user_session_active();?>', true, '<?php echo $product->mode_qnty;?>');" title="Buy Now" class="button quick_buy_button ">Buy Now</a> 
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
  <div class="tab_div bg">
    <table width="100%">
      <tbody>
        <tr>
          <td valign="top" width="100%"><div>
              <div class="product_page_tabs">
                <div id="notetabs" class="notestab"> 
                  <a href="#tab-more-details" class="selected">Product Info</a> 
                  <a href="#tab-notes">Notes</a> 
                  <a href="#tab-shipping_policy_tab">Shipping Policy</a> 
                  <a href="#tab-payment_policy_tab">Payment Policy</a> 
                  <a href="#tab-cashback_policy_tab">Cashback Policy</a> 
                  <a href="#tab-review">Reviews</a> </div>
                <div id="tab-more-details" class="tab-content" style="display: block;">
                  <div class="more_details">
                    <table width="100%">
                      <tbody>
                        <tr>
                          <td class="variation_td"><div> <span class="variation_name">Product Code</span><b>:</b><span class="tab_prd_val"><?php echo $product->sku;?></span></div></td>
                        </tr>
                        <?php
                          if(!empty($prd_ent)){
                            foreach ($prd_ent as $key => $value) {
                        ?>
                          <tr>
                            <td class="variation_td"><div><span class="variation_name"><?php echo $value['name'];?></span><b>:</b><span class="tab_prd_val"><?php echo $value['data'];?></span></div></td>
                          </tr>
                        <?php
                            }
                          }
                        ?>
                        <tr>
                          <td class="variation_td"><div><span class="variation_name">Content</span><b>:</b> <span class="tab_prd_val"><?php echo $product->content;?></span></div></td>
                        </tr>
                        <?php
                          if(!empty($product_attr)){
                            foreach ($product_attr as $key => $value) {
                        ?>
                          <tr>
                            <td class="variation_td"><div><span class="variation_name"><?php echo $value->name;?></span><b>:</b> <span class="tab_prd_val"><?php echo $value->value.'&nbsp;'.$value->unit;?></span></div></td>
                          </tr>
                        <?php
                            }
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div id="tab-notes" class="tab-content" style="display: none;">
                  <?php echo $product->note;?> 
                </div>
                
                
                <div id="tab-shipping_policy_tab" class="tab-content" style="display: none;">              
                  <div><strong>Shipping</strong></div>
                  
                  <ul>
                    <li><strong>Shipping Time</strong></li>
                  </ul>
                  <div>5 - 10 Business days for Un-Stitched product.</div>
                  <div style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;"> &nbsp;</div>
                  
                  <p style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;"> <strong style="font-family: georgia, serif; font-size: 14px;">Shipping Inside India</strong></p>
                  <div>Free Shipping all Location in India.</div>
                  <div style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;"> &nbsp;</div>
                </div>

                <div id="tab-payment_policy_tab" class="tab-content" style="display: none;">
                  <p style="margin-top: 0px; margin-bottom: 20px; color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;"> <span style="font-size:12px;"><strong style="font-family: georgia, serif;">You can choose from any of the following modes to make payment for your purchases on&nbsp;<a href="<?php echo base_url();?>" style="text-decoration-line: none; color: rgb(51, 51, 51); cursor: pointer;"><?php echo $this->defaultdata->getDomain(base_url());?></a></strong></span></p>
                  <ul style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;">
                    <li> <span style="font-size:12px;"><span style="font-family:arial,helvetica,sans-serif;"><span style="font-family:georgia,serif;"><strong>COD :</strong></span>&nbsp;Cash on Delivery, where you can pay by Cash on receipt of product.<span style="color:#a9a9a9;"> (India Only.)</span></span></span></li>
                  </ul>
                  <ul style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;">
                    <li> <span style="font-size:12px;"><span style="font-family: arial, helvetica, sans-serif;"><span style="font-family: georgia, serif;"><strong>Direct Bank Transfer :</strong></span>&nbsp;Pay via Bank Transfer.&nbsp;</span><span style="color:#a9a9a9;">(India <!--&amp; International.-->)</span></span></li>
                  </ul>
                  <ul style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;">
                    <li> <span style="font-size:12px;"><span style="font-family:arial,helvetica,sans-serif;"><span style="font-family:georgia,serif;"><strong>Net banking :</strong></span>&nbsp;All the major banks. Details available at Checkout.</span></span></li>
                  </ul>
                  <ul style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;">
                    <li> <span style="font-size:12px;"><span style="font-family:arial,helvetica,sans-serif;"><span style="font-family:georgia,serif;"><strong>Domestic Payment Gateway :</strong></span>&nbsp;CC Avenue(All Mesure Card Accepted).&nbsp;</span><span style="color:#a9a9a9;">(India Only.)</span></span></li>
                  </ul>
                </div>

                <div id="tab-cashback_policy_tab" class="tab-content" style="display: none;">
                  <ul>
                    <li style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;"> <span style="font-size:12px;"><span style="font-family:georgia,serif;"><strong>What is Cashback?</strong></span></span></li>
                  </ul>
                  <p style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;"> <span style="font-size:12px;"><span style="font-family:arial,helvetica,sans-serif;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Cashback is a form of discount amount that we credit back into your wallet after a successful purchase. This amount is used to make additional purchase on the&nbsp;</span><span style="font-family: arial, helvetica, sans-serif;">website.</span></span></p>
                  <ul>
                    <li style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;"> <span style="font-size:12px;"><span style="font-family:georgia,serif;"><strong>How will I receive my Cashback?</strong></span></span></li>
                  </ul>
                  <div style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;"> <span style="font-size:12px;"><span style="font-family:arial,helvetica,sans-serif;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Cashback is credited in your account as soon as the order is shipped from our facility.</span></span></div>
                  <ul>
                    <li style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;"> <span style="font-size:12px;"><span style="font-family:georgia,serif;"><strong>Where can I use my Cashback?</strong></span></span></li>
                  </ul>
                  <div style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;"> <span style="font-size:12px;"><span style="font-family:arial,helvetica,sans-serif;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; You can use the cash back on the entire store.</span></span></div>
                  <ul>
                    <li style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;"> <span style="font-size:12px;"><span style="font-family:georgia,serif;"><strong>How can I use my cashback?</strong></span></span></li>
                  </ul>
                  <div style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;"> <span style="font-size:12px;"><span style="font-family:arial,helvetica,sans-serif;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; You can use your cash back wallet amount to make a purchase of anything on the website. &nbsp;Cashback discount amount from your wallet can be redeemed to a</span></span></div>
                  <div style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;"> <span style="font-size:12px;"><span style="font-family:arial,helvetica,sans-serif;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; maximum of 5% of your cart value or amount available in your cash back wallet, whichever is lower.</span></span></div>
                </div>

                <div id="tab-review" class="tab-content" style="display: none;"> 
                  <div class="tab-reviews">
                    <div class="box-heading">
                      <h2>Reviews</h2>
                    </div>
                    <div id="">
                      <div id="review">
                        <?php
                          if(empty($reviews)){
                            echo '<div class="content">There are no reviews for this product.</div>';
                          }else{
                        ?>
                        <div class="card">
                            <div class="card-body">
                              <?php
                                foreach ($reviews as $key => $value) {
                              ?> 
                              <div class="card card-inner">
                                  <div class="card-body">
                                      <div class="row">
                                          <div class="col-sm-1">
                                              <?php
                                                if($value->file_name){
                                              ?>
                                              <img src="<?php echo UPLOAD_PROFILE_IMAGE_PATH.$value->file_name;?>" class="img img-rounded img-fluid"/>
                                              <?php
                                                }else{
                                              ?>
                                              <img src="<?php echo base_url('resources/images/def_face1.jpg');?>" class="img img-rounded img-fluid"/>
                                              <?php
                                                }
                                              ?>
                                          </div>
                                          <div class="col-sm-10">
                                              <p><a href="#"><strong><?php echo $value->reviewer;?></strong></a>
                                              	<span class="text-secondary date-block"><?php echo $this->defaultdata->time_elapsed_string('@'.$value->date_added);?></span>
                                              </p>                                               
                                              <p><?php echo $value->review;?></p>
                                              <p class="rating">
                                                <?php
                                                  for($i=1;$i<6;$i++){
                                                    if($i <= $value->rating){
                                                      echo '<span class="fa fa-star checked"></span>';
                                                    }else{
                                                      echo '<span class="fa fa-star"></span>';
                                                    } 
                                                  }
                                                ?>
                                              </p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <?php
                                }
                              ?>   
                            </div>
                        </div>
                        <?php
                          }
                        ?>    
                      </div>
                    </div>
                    <a data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#reviews_box" href="javascript:void(0);" title="Write a Review" class="reviews_inline button cboxElement">Write a Review</a> 
                  </div>
                </div>

              </div>
            </div></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class="container detailsPage">  
  <div class="row">
    <div class="col-md-12 moreThisCollection">
      <div class="moreCollectTitle">
        <h3>More from this Collections</h3>
      </div>
      <div class="row">
        <div id="more-collections" class="owl-carousel">
          <?php
            if(!empty($more_products)){
              foreach ($more_products as $key => $value) {
          ?>
          <div class="item">
            <div class="item-inner">
              <div class="productIconBox"> <a href="javascript:void(0)" onclick="add_cart('')" data-toggle="tooltip" data-placement="left" title="Add To Cart" ><i aria-hidden="true" class="fa fa-shopping-cart"></i></a> <a href="javascript:void(0)" onclick="addToWishList('<?php echo $value->product_id;?>', '<?php echo $this->defaultdata->is_user_session_active();?>');" data-toggle="tooltip" data-placement="left" title="Add To Wishlist" ><i aria-hidden="true" class="fa fa-heart-o"></i></a> </div>
              <div class="images-container"><a href="<?php echo base_url('product-details/'.$value->slug);?>"><img src="<?php echo UPLOAD_PRODUCT_PATH.pathinfo($value->prd_img_name, PATHINFO_FILENAME).'_l.'.pathinfo($value->prd_img_name, PATHINFO_EXTENSION);?>" alt="<?php echo $value->prd_name;?>"></a></div>
              <div class="productDetailsBtn"><a href="<?php echo base_url('product-details/'.$value->slug);?>" title="<?php echo $value->prd_name;?>">View Details</a></div>
            </div>
            <div class="des-container">
              <div class="name"><a href="<?php echo base_url('product-details/'.$value->slug);?>"><?php echo $value->prd_name;?></a></div>
              <?php
                if($value->prd_dic_chk == "Y"){
              ?>
              <div class="price"> 
                <span class="old-price"><strike class="sm"><i class="fa fa-inr"></i><?php echo $value->price;?></strike></span>
                <span><i class="fa fa-inr"></i><?php echo $value->discounted_price;?></span> 
                 <?php
                    if($value->prd_dis_mode == "per"){
                  ?>
                  <span class="price-dis"><?php echo $value->prd_dis_amt;?>% OFF</span>
                  <?php 
                    }else{
                  ?>
                  <span class="price-dis"><i class="fa fa-inr"></i><?php echo $value->prd_dis_amt;?> OFF</span>
                  <?php
                    }
                  ?>
              </div>
              <?php
                }else{
              ?>
              <div class="price"> <span><i class="fa fa-inr"></i><?php echo $value->price;?></span> </div>
              <?php
                }
              ?>
              <div class="productDetailsBtn"><a href="<?php echo base_url('product-details/'.$value->slug);?>" title="<?php echo $value->prd_name;?>">View Details</a></div>
            </div>
          </div>
          <?php
              }
            }
          ?>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 moreThisCollection">
      <div class="moreCollectTitle">
        <h3>Best Selling Products</h3>
      </div>
      <div class="row">
        <div id="best-selling-products" class="owl-carousel">
          <?php
            if(!empty($best_selling_products)){
              foreach ($best_selling_products as $key => $value) {
          ?>
          <div class="item">
            <div class="item-inner">
              <div class="productIconBox"> <a href="javascript:void(0)" onclick="add_cart('')" data-toggle="tooltip" data-placement="left" title="Add To Cart" ><i aria-hidden="true" class="fa fa-shopping-cart"></i></a> <a href="javascript:void(0)" onclick="addToWishList('<?php echo $value->product_id;?>', '<?php echo $this->defaultdata->is_user_session_active();?>');" data-toggle="tooltip" data-placement="left" title="Add To Wishlist" ><i aria-hidden="true" class="fa fa-heart-o"></i></a> </div>
              <div class="images-container"><a href="<?php echo base_url('product-details/'.$value->slug);?>"><img src="<?php echo UPLOAD_PRODUCT_PATH.pathinfo($value->prd_img_name, PATHINFO_FILENAME).'_l.'.pathinfo($value->prd_img_name, PATHINFO_EXTENSION);?>" alt="<?php echo $value->prd_name;?>"></a></div>
              <div class="productDetailsBtn"><a href="<?php echo base_url('product-details/'.$value->slug);?>" title="<?php echo $value->prd_name;?>">View Details</a></div>
            </div>
            <div class="des-container">
              <div class="name"><a href="<?php echo base_url('product-details/'.$value->slug);?>"><?php echo $value->prd_name;?></a></div>
              <?php
                if($value->prd_dic_chk == "Y"){
              ?>
              <div class="price"> 
                <span class="old-price"><strike class="sm"><i class="fa fa-inr"></i><?php echo $value->price;?></strike></span>
                <span><i class="fa fa-inr"></i><?php echo $value->discounted_price;?></span> 
                 <?php
                    if($value->prd_dis_mode == "per"){
                  ?>
                  <span class="price-dis"><?php echo $value->prd_dis_amt;?>% OFF</span>
                  <?php 
                    }else{
                  ?>
                  <span class="price-dis"><i class="fa fa-inr"></i><?php echo $value->prd_dis_amt;?> OFF</span>
                  <?php
                    }
                  ?>
              </div>
              <?php
                }else{
              ?>
              <div class="price"><span><i class="fa fa-inr"></i><?php echo $value->price;?></span> </div>
              <?php
                }
              ?>
              <div class="productDetailsBtn"><a href="<?php echo base_url('product-details/'.$value->slug);?>" title="<?php echo $value->prd_name;?>">View Details</a></div>
            </div>
          </div>
          <?php
              }
            }
          ?>
        </div>
      </div>
    </div>
  </div>

</div>
 
  <?php echo $how_to_measure;?>

    
  <?php echo $size_chart;?>

  <?php echo $review_modal;?>
      
<?php echo $footer; ?>
<?php echo $foot; ?>