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
      <div class="productIconBox"> <a href="javascript:void(0);" style="display:block" onclick="remove_from_wishlist('<?php echo $value->product_id;?>', '<?php echo $this->defaultdata->is_user_session_active();?>')" data-toggle="tooltip" data-placement="left" title="" data-original-title="Remove From Wishlist"><i aria-hidden="true" class="fa fa-heart-o"></i></a> </div>
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