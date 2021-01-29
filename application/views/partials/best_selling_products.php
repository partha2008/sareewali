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