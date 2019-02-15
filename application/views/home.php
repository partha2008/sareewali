    <?php echo $head; ?>
    <?php echo $header; ?>

    <?php
        if(!empty($banner_list)){
            ?>
            <div class="slider-area">
              <ul class="rslides" id="slider4">
                <?php
                foreach($banner_list AS $list){
                    ?>
                    <li> 
                        <a href="#">
                            <img src="<?php echo $list->path;?>" alt="<?php echo $list->title;?>" border="0"/>
                        </a>
                        <p class="wow bounceInDown caption"> <span></span> </p>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    <?php
        }
    ?>

    <section class="banner-area wow fadeInDown">
      <div class="container">
        <div class="row">
          <?php
          if(isset($enity_list[0])){
            $file_ext_ = strtolower(pathinfo($enity_list[0]->image_path, PATHINFO_EXTENSION));
            $file_name_ = basename($enity_list[0]->image_path, '.'.$file_ext_);
            $file_with_ext = $file_name_.'_l.'.$file_ext_;
          ?>
          <div class="col-md-6"> 
            <a href="products.html">
              <div class="cat-item">
                <div class="images-container">
                  <img class="img-responsive" src="<?php echo UPLOAD_ENTITY_PATH. $file_with_ext;?>" />
                </div>
                <div class="des-container">
                  <div class="desk-container-Table">
                    <div class="deskContainerTableCell"> 
                      <span class="name"><?php echo ucfirst($enity_list[0]->name);?></span> 
                      <span class="disc"><?php echo $enity_list[0]->description;?></span> 
                      <span class="btn-collection">Explore Collection <i aria-hidden="true" class="fa fa-long-arrow-right"></i></span> 
                    </div>
                  </div>
                </div>
              </div>
            </a> 
        </div>
        <?php
        }
        if(isset($enity_list[1])){
          $file_ext_ = strtolower(pathinfo($enity_list[1]->image_path, PATHINFO_EXTENSION));
          $file_name_ = basename($enity_list[1]->image_path, '.'.$file_ext_);
          $file_with_ext = $file_name_.'_s.'.$file_ext_;
        ?>
      <div class="col-md-6">
        <div class="row">
          <div class="col-xs-6 col-sm-6 col-md-6 desContainerSmallBox"> 
            <a href="products.html">
              <div class="cat-item banner2">
                <div class="images-container">
                  <img class="img-responsive" src="<?php echo UPLOAD_ENTITY_PATH. $file_with_ext;?>" />
                </div>
                <div class="des-container">
                  <div class="desk-container-Table">
                    <div class="deskContainerTableCell"> 
                      <span class="name"><?php echo ucfirst($enity_list[1]->name);?></span> 
                      <span class="disc"><?php echo $enity_list[1]->description;?></span> 
                      <span class="btn-collection">Explore Collection <i aria-hidden="true" class="fa fa-long-arrow-right"></i></span> 
                    </div>
                  </div>
                </div>
              </div>
            </a> 
          </div>
          <?php
          }
          if(isset($enity_list[2])){
            $file_ext_ = strtolower(pathinfo($enity_list[2]->image_path, PATHINFO_EXTENSION));
            $file_name_ = basename($enity_list[2]->image_path, '.'.$file_ext_);
            $file_with_ext = $file_name_.'_s.'.$file_ext_;
          ?>
          <div class="col-xs-6 col-sm-6 col-md-6 desContainerSmallBox"> 
            <a href="products">
              <div class="cat-item banner3">
                <div class="images-container">
                  <img class="img-responsive" src="<?php echo UPLOAD_ENTITY_PATH. $file_with_ext;?>" />
                </div>
                <div class="des-container">
                  <div class="desk-container-Table">
                    <div class="deskContainerTableCell"> 
                      <span class="name"><?php echo ucfirst($enity_list[2]->name);?></span> 
                      <span class="disc"><?php echo $enity_list[2]->description;?></span> 
                      <span class="btn-collection">Explore Collection <i aria-hidden="true" class="fa fa-long-arrow-right"></i></span> 
                    </div>
                  </div>
                </div>
              </div>
            </a> 
          </div>
        </div>
        <?php
        }
        if(isset($enity_list[3])){
            $file_ext_ = strtolower(pathinfo($enity_list[3]->image_path, PATHINFO_EXTENSION));
            $file_name_ = basename($enity_list[3]->image_path, '.'.$file_ext_);
            $file_with_ext = $file_name_.'_m.'.$file_ext_;
          ?>
        <div class="row">
          <div class="col-md-12"> 
            <a href="products.html">
              <div class="cat-item banner4">
                <div class="images-container">
                  <img class="img-responsive" src="<?php echo UPLOAD_ENTITY_PATH. $file_with_ext;?>" />
                </div>
                <div class="des-container">
                  <div class="desk-container-Table">
                    <div class="deskContainerTableCell"> 
                      <span class="name"><?php echo ucfirst($enity_list[3]->name);?></span> 
                      <span class="disc"><?php echo $enity_list[3]->description;?></span> 
                      <span class="btn-collection">Explore Collection <i aria-hidden="true" class="fa fa-long-arrow-right"></i></span> 
                    </div>
                  </div>
                </div>
              </div>
            </a> 
          </div>
        </div>
        <?php
        }
        ?>
    </div>
    </div>

    </div>

    </section>



    <!-- newpromoblock --->

    <section class="banner-area wow fadeInDown newpromoblock">

      <div class="container">

        <div class="row">               

          <div class="col-xs-12 col-md-6">

            <a href="theme-1"><img alt="EOSS: Bestseller items at Flat 20% Off. Shop!" class="img-responsive lazyloaded" src="<?php echo base_url(); ?>resources/images/bestsellers.jpg" title="EOSS: Bestseller items at Flat 20% Off. Shop!" data-src="<?php echo base_url(); ?>resources/images/bestsellers.jpg"></a>

        </div>

        <div class="col-xs-12 col-md-6">

            <a href="theme-4"><img alt="EOSS: Clearance Sale of min. 50 - 70% Off. Shop!" class="img-responsive lazyloaded" src="<?php echo base_url(); ?>resources/images/clearance-sale-newupd.jpg" title="EOSS: Clearance Sale of min. 50 - 70% Off. Shop!" data-src="<?php echo base_url(); ?>resources/images/clearance-sale-newupd.jpg"></a>

        </div>



    </div>

    </div>

    </section>   





    <section class="new-arrival wow fadeInDown">

      <div class="container">

        <div class="title">

          <h2>New Arrivals</h2>

      </div>

      <div class="row">

          <div id="new-arrival" class="owl-carousel">
            <?php
              if(!empty($products)){
                foreach ($products as $product) {
            ?>
            <div class="item">
              <div class="item-inner">
                <div class="productIconBox"> 
                  <a href="javascript:void(0)" data-toggle="tooltip" data-placement="left" title="Add To Cart" ><i aria-hidden="true" class="fa fa-shopping-cart"></i></a> 
                  <a onclick="addToWishList('<?php echo $product->product_id;?>', '<?php echo $this->defaultdata->is_user_session_active();?>');" href="javascript:void(0)" data-toggle="tooltip" data-placement="left" title="Add To Wishlist" ><i aria-hidden="true" class="fa fa-heart-o"></i></a> 
                </div>
                <div class="new-off">
                  <div class="new-percent">New</div>
              </div>
              <div class="images-container">
                <a href="<?php echo base_url('product-details/'.$product->slug);?>">
                  <img src="<?php echo UPLOAD_PRODUCT_PATH.pathinfo($product->prd_img_name, PATHINFO_FILENAME).'_s.'.pathinfo($product->prd_img_name, PATHINFO_EXTENSION);?>" alt="<?php echo $product->prd_name;?>">
                </a>
              </div>
              <div class="productDetailsBtn">
                <a href="<?php echo base_url('product-details/'.$product->slug);?>" title="View Details">View Details</a>
              </div>
          </div>
          <div class="des-container">
            <div class="name"><a href="<?php echo base_url('product-details/'.$product->slug);?>"><?php echo $product->prd_name;?></a></div>
            <div class="price"> <span><i class="fa fa-inr"></i> <?php echo $product->price;?></span> </div>
            <div class="productDetailsBtn"><a href="<?php echo base_url('product-details/'.$product->slug);?>" title="">View Details</a></div>
        </div>
    </div>
    <?php
        }
      }
    ?>

    </div>



    <div class="col-xs-12 viewmore-block">

        <div class="uf-nosto-viewmore">

            <a class="uf-black-border-button" href="javascript:void(0);">View More Recommendation</a>

        </div>

    </div>



    </div>

    </div>

    </section>





    <section class="banner-area wow fadeInDown newpromoblock">

      <div class="container">

        <div class="row"> 



            <div class="col-xs-12" style="margin-top: 10px;"><a href="javascript:void(0);"><img alt="" class="hs-showinmobile" src="<?php echo base_url(); ?>resources/images/usignature-0208-mobile.jpg" title="Available only in Saree Wali:embroidered abayas, Rajasthani sarees &amp; more. Shop!"><img alt="" class="hide-below-768" src="<?php echo base_url(); ?>resources/images/usignature-0208.jpg" title="Available only in Saree Wali:embroidered abayas, Rajasthani sarees &amp; more. Shop!"></a></div>



        </div>

    </div>

    </section>




<?php
  if($section_list[0]->status == 'Y'){
?>
    <section class="new-arrival wow fadeInDown">
        <div class="container">
          <div class="title">
            <h2>THE GLAM AVATAR OF DESI WEAR</h2>
        </div>
        <div class="row">
          <?php
            if(!empty($ads_list)){
              foreach ($ads_list as $value) {
                if($value->parent_id == 1){
          ?>
          <div class="col-md-6">
              <a href="javascript:void(0);">
                <img alt="<?php echo $value->image_path;?>" class="img-responsive" src="<?php echo UPLOAD_ADS_PATH.$value->image_path;?>" title="<?php echo $value->image_path;?>" data-src="<?php echo UPLOAD_ADS_PATH.$value->image_path;?>">
              </a>
          </div>
          <?php
              }
            }
          }
          ?>
        </div>
      </div>
    </section>
<?php
  }
?>


<?php
  if($section_list[1]->status == 'Y'){
?>

    <section class="featured-product wow fadeInDown curated-fashion-stories">

      <div class="container">

        <div class="title">

          <h2>OUR CURATED FASHION STORIES</h2>

      </div>

      <div class="row">

          <div id="featured-product" class="owl-carousel">
            <?php
            if(!empty($ads_list)){
              foreach ($ads_list as $value) {
                if($value->parent_id == 2){
          ?>
            <div class="item">



              <div class="item-inner">

                <a href="javascript:void(0);"><img alt="<?php echo $value->image_path;?>" title="<?php echo $value->image_path;?>" src="<?php echo UPLOAD_ADS_PATH.$value->image_path;?>"></a>

            </div>

        </div>
          <?php
            }
          }
        }

          ?>


    </div>

    </div>

    </div>

    </section>
<?php
  }
?>
<?php
  if($section_list[2]->status == 'Y'){
?>

    <section class="new-arrival wow fadeInDown gifting-season">

      <div class="container">

        <div class="title">

          <h2>THE SEASON OF GIFTING</h2>

      </div>

      <div class="row">
        <?php
            if(!empty($ads_list)){
              foreach ($ads_list as $value) {
                if($value->parent_id == 3){
          ?>
        <div class="col-md-6">

            <a href="javascript:void(0);">
              <img alt="<?php echo $value->image_path;?>" class="img-responsive" src="<?php echo UPLOAD_ADS_PATH.$value->image_path;?>" title="<?php echo $value->image_path;?>" data-src="<?php echo UPLOAD_ADS_PATH.$value->image_path;?>">
            </a>

        </div>
        <?php
          }
        }
      }
        ?>


    </div>

    </div>

    </section>

<?php
  }
?>


<?php
  if($section_list[3]->status == 'Y'){
?>
    <section class="featured-product wow fadeInDown everyone-alltime-stories">

      <div class="container">

        <div class="title">

          <h2>FOR EVERYONE. AT ALL TIMES.</h2>

      </div>

      <div class="row">

          <div id="everyone-alltime" class="owl-carousel">
            <?php
            if(!empty($ads_list)){
              foreach ($ads_list as $value) {
                if($value->parent_id == 4){
          ?>
            <div class="item">

              <div class="item-inner">

                <a href="javascript:void(0);"><img alt="<?php echo $value->image_path;?>" title="<?php echo $value->image_path;?>" src="<?php echo UPLOAD_ADS_PATH.$value->image_path;?>"></a>

            </div>

        </div>
        <?php
      }
    }
  }
        ?>



    </div>

    </div>

    </div>

    </section>

<?php
  }
?>



    <section class="news-letter wow fadeInDown">

      <div class="container">

        <div class="title">

          <h2>NEWSLETTER <span>SUBSCRIBE</span></h2>

      </div>

      <div class="news-letter-content">Subscribe to the maroko mailing list to receive updates on new arrivals, special offers and other discount information.</div>

      <div class="newleter-content">

          <form id="frmNewsletter">

            <span class="error"></span> <span class="success"></span>

            <div class="subscribeEmail">

              <input placeholder="Your Email Address" type="text" id="subscribe_email" name="email" value="">

              <input type="hidden" value="Subscribe Newsletter" name="action">

          </div>

          <div class="subscribeBtn"> <a id="newsltter-btn" href="javascript:void(0)" class="button"><span>Subscribe</span></a> </div>

      </form>

    </div>

    </div>

    </div>

    </section>

    <section class="policy-item wow fadeInDown">

      <div class="container">

        <div class="row">

          <div class="col-sm-12 col-md-12"> <i class="policy-icon icon-shipping"></i>

            <div class="policy-content"><span>Free Shipping</span>all over India</div>

        </div>

        <!--<div class="col-sm-4 col-md-4"> <i class="policy-icon icon-tailoring"></i>

            <div class="policy-content"><span>Custom Tailoring</span>Blouse Stitching as per size</div>

        </div>

        <div class="col-sm-4 col-md-4"> <i class="policy-icon icon-wshipping"></i>

            <div class="policy-content"><span>Worldwide Shipping</span>Get Delivery all over world</div>

        </div>-->

    </div>

    </div>

    </section>




    <?php echo $upper_footer;?>
    <?php echo $footer; ?>
    <?php echo $foot; ?>

