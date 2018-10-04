          <?php
            if(!empty($product_list)){
              foreach ($product_list as $list) {
          ?>
          <div class="categoryProduct col-xs-6 col-sm-4">
            <div class="item">
              <div class="item-inner">
                <div class="productIconBox"> 
                  <a href="javascript:void(0);" onclick="add_to_cart('<?php echo $list->slug;?>')" data-toggle="tooltip" data-placement="left" title="Add To Cart" ><i aria-hidden="true" class="fa fa-shopping-cart"></i>
                  </a> 
                  <a href="javascript:void(0);" onclick="add_to_wishlist('<?php echo $list->slug;?>')" data-toggle="tooltip" data-placement="left" title="Add To Wishlist" ><i aria-hidden="true" class="fa fa-heart-o"></i>
                  </a> 
                </div>
                <div class="productDetailsBtn"><a href="<?php echo base_url('product-details/'.$list->slug);?>" title="">View Details</a></div>

                <!--<div class="new-off">
                  <div class="new-percent">New</div>
                </div>-->
                <div class="images-container">
                  <a href="<?php echo base_url('product-details/'.$list->slug);?>">
                    <img class="lazy" data-src="<?php echo UPLOAD_PRODUCT_PATH.pathinfo($list->prd_img_name, PATHINFO_FILENAME).'_l.'.pathinfo($list->prd_img_name, PATHINFO_EXTENSION);?>">
                  </a>
                </div>
              </div>

              <div class="des-container">
                <div class="name">
                  <a href="product-details.html"><?php echo $list->prd_name;?></a>
                </div>
                <div class="price"> 
                  <!--<span class="old-price"><strike><i class="fa fa-inr"></i>8,700</strike></span>--> 
                  <span><i class="fa fa-inr"></i> <?php echo $list->price;?></span>
                </div>
                <div class="productDetailsBtn"><a href="<?php echo base_url('product-details/'.$list->slug);?>" title="">View Details</a></div>
              </div>
            </div>
          </div>
          <?php
            }
          }
          ?>