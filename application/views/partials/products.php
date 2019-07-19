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
                  <a href="javascript:void(0);" onclick="addToWishList('<?php echo $list->product_id;?>', '<?php echo $this->defaultdata->is_user_session_active();?>');" data-toggle="tooltip" data-placement="left" title="Add To Wishlist" ><i aria-hidden="true" class="fa fa-heart-o"></i>
                  </a> 
                </div>
                <div class="productDetailsBtn"><a href="<?php echo base_url('product-details/'.$list->slug);?>" title="">View Details</a></div>
                <?php
                  if($list->is_new == "YES"){
                ?>
                <div class="new-off">
                  <div class="new-percent">New</div>
                </div>
                <?php
                  }
                ?>
                <div class="images-container">
                  <a href="<?php echo base_url('product-details/'.$list->slug);?>">
                    <img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo UPLOAD_PRODUCT_PATH.pathinfo($list->prd_img_name, PATHINFO_FILENAME).'_l.'.pathinfo($list->prd_img_name, PATHINFO_EXTENSION);?>" data-src-retina="<?php echo UPLOAD_PRODUCT_PATH.pathinfo($list->prd_img_name, PATHINFO_FILENAME).'_l.'.pathinfo($list->prd_img_name, PATHINFO_EXTENSION);?>">
                  </a>
                </div>
              </div>

              <div class="des-container">
                <div class="name">
                  <a href="<?php echo base_url('product-details/'.$list->slug);?>"><?php echo $list->prd_name;?></a>
                </div>
                <div class="price">
                  <?php
                    if($list->prd_dic_chk == "Y"){
                  ?> 
                  <span class="old-price"><strike><i class="fa fa-inr"></i><?php echo $list->price;?></strike></span>
                  <span><i class="fa fa-inr"></i><?php echo $list->discounted_price;?></span>
                  <?php
                    if($list->prd_dis_mode == "per"){
                  ?>
                  <span class="price-dis"><?php echo $list->prd_dis_amt;?>% OFF</span>
                  <?php 
                    }else{
                  ?>
                  <span class="price-dis"><i class="fa fa-inr"></i><?php echo $list->prd_dis_amt;?> OFF</span>
                  <?php
                    }
                  ?>
                  <?php
                    }else{
                  ?>
                  <span><i class="fa fa-inr"></i> <?php echo $list->price;?></span>
                  <?php
                    }
                  ?>
                </div>
                <div class="productDetailsBtn"><a href="<?php echo base_url('product-details/'.$list->slug);?>" title="">View Details</a></div>
              </div>
            </div>
          </div>
          <?php
            }
          }
          ?>