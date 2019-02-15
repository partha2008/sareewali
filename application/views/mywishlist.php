<?php echo $head; ?>
<?php echo $header; ?>

<section class="breadcrumbs">
  <div class="container">
    <?php echo $breadcrumb;?>
  </div>
</section>

<section class="page-container">
  <div class="container checkoutPage">
    <div class="page-content">
      <h1 class="page-title">My Wishlist</h1>
      <div class="row">
        <?php echo $sidebar;?>
        <div class="col-md-9">
          <div class="row">
            <?php
              if(!empty($wishlist_data)){
                foreach ($wishlist_data as $key => $value) {
                  if($value->prd_dic_chk == "Y"){
                    $price = $value->discounted_price;
                  }else{
                    $price = $value->price;
                  }
            ?>
            <div class="categoryProduct col-xs-6 col-sm-4">
              <div class="item">
                <div class="item-inner">
                  <div class="productIconBox"> <a href="javascript:void(0);" style="display:block" onclick="remove_from_wishlist('458')" data-toggle="tooltip" data-placement="left" title="" data-original-title="Remove From Wishlist"><i aria-hidden="true" class="fa fa-heart-o"></i></a> </div>
                  <div class="productDetailsBtn"><a href="<?php echo base_url('product-details/'.$value->slug);?>" title="">View Details</a></div>
                  <div class="images-container"><a href="<?php echo base_url('product-details/'.$value->slug);?>"><img src="<?php echo UPLOAD_PRODUCT_PATH.pathinfo($value->prd_img_name, PATHINFO_FILENAME).'_s.'.pathinfo($value->prd_img_name, PATHINFO_EXTENSION);?>" alt="<?php echo $value->prd_name;?>"></a></div>
                </div>
                <div class="des-container">
                  <div class="name"><a href="<?php echo base_url('product-details/'.$value->slug);?>"><?php echo $value->prd_name;?></a></div>
                  <div class="price"><i class="fa fa-inr"></i> <?php echo $price;?></div>
                  <div class="productDetailsBtn"><a href="<?php echo base_url('product-details/'.$value->slug);?>" title="View Details">View Details</a></div>
                </div>
              </div>
            </div>
            <?php
              }
            }
            ?>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>  
</section>
<?php echo $footer; ?>
<?php echo $foot; ?>

