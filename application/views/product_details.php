      <?php echo $head; ?>
      <?php echo $header; ?>

      <section class="breadcrumbs">

        <div class="container">
          <?php echo $breadcrumb;?>
        </div>

      </section>

      <section class="page-container">
  <div class="container detailsPage">
    <div class="row">
      <div class="productDetailBox">
        <input type="hidden" name="ctl00$cphBody$__VIEWxSTATE" id="__VIEWxSTATE" value="NzY4Ozk7MTI=" />
        <div class="col-xs-12 col-md-6 productDetailLeft">
          <?php
            if(!empty($product_image)){
          ?>
          <ul id='girlstop1' class='gc-start'>
            <?php
              foreach ($product_image as $value) {
                
            ?>
            <li><img src="<?php echo UPLOAD_PRODUCT_PATH.pathinfo($value->name, PATHINFO_FILENAME).'_xl.'.pathinfo($value->name, PATHINFO_EXTENSION);?>" alt='<?php echo UPLOAD_PRODUCT_PATH.pathinfo($value->name, PATHINFO_FILENAME).'_xl.'.pathinfo($value->name, PATHINFO_EXTENSION);?>' data-gc-caption="dfdf-1" /></li>
            <?php
              }
            ?>
          </ul>
          <?php
            }
          ?>
        </div>
        <form id="frmProduct">
          <div class="col-xs-12 col-md-6 productDetailRight">
            <div class="error"></div>
            <h2 class="productTitle"><?php echo $product->name;?> 
              <span>
                <a href="javascript:void(0);" onclick="add_to_wishlist('<?php echo $product->slug;?> ')" data-toggle="tooltip" data-placement="left" title="Add To Wishlist" ><i class="fa fa-heart-o" aria-hidden="true"></i></a>
              </span>
            </h2>
            <div class="orderDiscription">
              <p><span>SKU :</span> <?php echo $product->sku;?> </p>
              <?php
                if(!empty($product_attr)){
                  foreach ($product_attr as $value) {
              ?>
              <p><span><?php echo ucfirst($value->name);?> :</span> <?php echo $value->value.$value->unit;?> </p>
              <?php 
                }
                }
                if($product->out_of_stock == 'Y'){
              ?>
              <p><span>Availability :</span> Out of Stock</p>
              <?php
                }
              ?>
              <div class="selectColorBox"> <span>Color : </span>
                <div class="shortByBox">Royal Blue
                  <div class="shortByDropDown">
                    <ul>
                      <li><a title="C60 Royal Blue & Red Pure Silk Kanchipuram Temple border  Saree wali Couture Designer Saree" href="#">Royal Blue</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              
              <!-- selectColorBox -->
              
              <div class="dg-product-description additional-product-type-configurable" itemprop="description">
                <h4>Product Highlights</h4>
                <?php echo $product->description;?>            
            </div>
        <!-- Check whether the plugin is enabled -->
                
                <!-- selectSizeBox --> 
                
            </div>
            <div class="orderRatingAmt"> 
              
              <!--<div class="ViewReview"><a href="javascript:void(0)" onclick="$('.resp-tabs-container div').hide();$('#reviewsdiv').show();$('#reviewsdiv div').show();$('.resp-tabs-list li').removeClass('resp-tab-active');$('#tab-review').addClass('resp-tab-active');">View review</a></div>-->
              
              <div class="amt"><i class="fa fa-inr"></i> <span id="actualPrice"><?php echo $product->price;?></span>
              <p class="minimal-price">
              <span class="price-label">Shipping</span>
              <span class="price aw-shipping-price aw-shipping-price-697336"><b style="color:#cb4551;">FREE</b></span>
              </p>
              </div>
                       
              <?php 
                if($product->out_of_stock == 'N'){
              ?>                  
              <a class="buyNowBtn" href="javascript:void(0)" id="btn-enquiry-product" data-toggle="modal" data-target="#product-enquiry">Buy Now</a>              
              <a class="addtoCart" href="javascript:void(0)"  data-toggle="modal" data-target="#product-enquiry">Add to Cart</a>
              <?php
                }
              ?>
              <input type="hidden" name="product_id" id="product_id" value="435" />
              <input type="hidden" name="size" id="size" value="" />
              
              <!-- <input type="hidden" name="price" id="price" value="28700.00" /> -->
              
              <input type="hidden" name="qty" id="qty" value="1" />
              <div class="codBox"> <span>Check COD available</span>
                <div id="pin-panel">
                  <div class="errors"></div>
                  <div class="successs"></div>
                </div>
                <input id="pin_code" name="pin_code" type="text" placeholder="Enter Pincode">
                <button id="btn-pin" onclick="return available_post_code($('#pin_code').val())">Check</button>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
          
          <!-- productDetailRight -->
          
        </form>
        <div aria-hidden="false" aria-labelledby="myLargeModalLabel" role="dialog" tabindex="-1" class="modal fade sizeChartPopup" id="sizeChartModal">
          <div class="modal-dialog modal-lg"> 
            
            <!-- Modal content-->
            
            <div class="modal-content">
              <div class="modal-header">
                <h2>Size Chart
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </h2>
              </div>
              <div class="modal-body text-center"> <img style="max-width:100%;" src="<?php echo base_url(); ?>/resources/images/size-chart.jpg" /> </div>
            </div>
          </div>
        </div>
        <div aria-hidden="false" aria-labelledby="myLargeModalLabel" role="dialog" tabindex="-1" class="modal fade sizeChartPopup" id="kurtaMeasurementModel">
          <div class="modal-dialog modal-lg"> 
            
            <!-- Modal content-->
            
            <div class="modal-content">
              <div class="modal-header">
                <h2>Tailoring Measurement
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </h2>
              </div>
              <div class="modal-body">
                <form id="frmKurtaMeasurement" name="frmKurtaMeasurement">
                  <div class="row">
                    <div class="col-xs-12 col-sm-8">
                      <div class="row">
                        <div class="col-xs-12 text-left">
                          <input type="radio" maxlength="5" size="1" value="1"  title="Regular Fit" name="fiting_option">
                          <strong>Regular Fit -</strong> <span style="font-size:12px;">Garments will be tailored exactly as per provided measurements</span></div>
                        <div class="col-xs-12 text-left">
                          <input type="radio" maxlength="5" size="1" value="2"  title="Comfort Fit" name="fiting_option">
                          <strong>Comfort Fit - </strong> <span style="font-size:12px;">Garments will be tailored with +2 inch or +5cm loosing (whichever unit is selected)</span></div>
                      </div>
                      <br>
                      <div style="overflow-x:auto;">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table">
                          <tr class="customTailoringHead">
                            <th width="35%">Measurement</th>
                            <th width="15%">Inch</th>
                            <th width="35%">Measurement</th>
                            <th width="15%">Inch</th>
                          </tr>
                          <tr>
                            <td valign="middle">1. Kurta Length/Anarkali Length</td>
                            <td><input type="text" maxlength="5" size="1" value="" title="" name="kurta_measurement_list[1]" class="form-control"></td>
                            <td valign="middle">2. Upper Chest</td>
                            <td><input type="text" maxlength="5" size="1" value="" title="" name="kurta_measurement_list[2]" class="form-control"></td>
                          </tr>
                          <tr>
                            <td valign="middle">3. Chest</td>
                            <td><input type="text" maxlength="5" size="1" value="" title="" name="kurta_measurement_list[3]" class="form-control"></td>
                            <td valign="middle">4. Above Novel</td>
                            <td><input type="text" maxlength="5" size="1" value="" title="" name="kurta_measurement_list[4]" class="form-control"></td>
                          </tr>
                          <tr>
                            <td valign="middle">5. Shoulder</td>
                            <td><input type="text" maxlength="5" size="1" value="" title="" name="kurta_measurement_list[5]" class="form-control"></td>
                            <td valign="middle">6. Armhole</td>
                            <td><input type="text" maxlength="5" size="1" value="" title="" name="kurta_measurement_list[6]" class="form-control"></td>
                          </tr>
                          <tr>
                            <td valign="middle">7. Hip</td>
                            <td><input type="text" maxlength="5" size="1" value="" title="" name="kurta_measurement_list[7]" class="form-control"></td>
                            <td valign="middle">8. Sleeves Length</td>
                            <td><input type="text" maxlength="5" size="1" value="" title="" name="kurta_measurement_list[8]" class="form-control"></td>
                          </tr>
                          <tr>
                            <td valign="middle">9. Sleeves Round</td>
                            <td><input type="text" maxlength="5" size="1" value="" title="" name="kurta_measurement_list[9]" class="form-control"></td>
                            <td valign="middle">10. Waist</td>
                            <td><input type="text" maxlength="5" size="1" value="" title="" name="kurta_measurement_list[10]" class="form-control"></td>
                          </tr>
                          <tr>
                            <td valign="middle">11. Front Neck</td>
                            <td><input type="text" maxlength="5" size="1" value="" title="" name="kurta_measurement_list[11]" class="form-control"></td>
                            <td valign="middle">12. Back Neck</td>
                            <td><input type="text" maxlength="5" size="1" value="" title="" name="kurta_measurement_list[12]" class="form-control"></td>
                          </tr>
                          <tr>
                            <td valign="middle">13. Waist to ankle</td>
                            <td><input type="text" maxlength="5" size="1" value="" title="" name="kurta_measurement_list[13]" class="form-control"></td>
                            <td valign="middle">14. Thighs (All around)</td>
                            <td><input type="text" maxlength="5" size="1" value="" title="" name="kurta_measurement_list[14]" class="form-control"></td>
                          </tr>
                          <tr>
                            <td valign="middle">15. Knee (All around)</td>
                            <td><input type="text" maxlength="5" size="1" value="" title="" name="kurta_measurement_list[15]" class="form-control"></td>
                            <td valign="middle">16. Calf (All around)</td>
                            <td><input type="text" maxlength="5" size="1" value="" title="" name="kurta_measurement_list[16]" class="form-control"></td>
                          </tr>
                          <tr>
                            <td valign="middle">17. Ankle (All around)</td>
                            <td><input type="text" maxlength="5" size="1" value="" title="" name="kurta_measurement_list[17]" class="form-control"></td>
                            <td valign="middle">18. Height</td>
                            <td><input type="text" maxlength="5" size="1" value="" title="" name="kurta_measurement_list[18]" class="form-control"></td>
                          </tr>
                          <tr>
                            <td><h4>Sleeves Option</h4></td>
                            <td colspan="3" valign="middle"><input type="radio" maxlength="5" size="1" value="1"  title="No Sleeves" name="sleeve_option">
                              No Sleeves &nbsp; &nbsp;
                              <input type="radio" maxlength="5" size="1" value="2"  title="Cap Sleeves" name="sleeve_option">
                              Cap Sleeves &nbsp; &nbsp;
                              <input type="radio" maxlength="5" size="1" value="3"  title="Full Sleeves" name="sleeve_option">
                              Full Sleeves &nbsp; &nbsp; </td>
                          </tr>
                          <tr>
                            <td><h4>Alteration Option</h4></td>
                            <td colspan="3" valign="middle"><input type="radio" maxlength="5" size="1" value="1"  title="Major Alteration" name="alteration_option">
                              Major Alteration &nbsp; &nbsp;
                              <input type="radio" maxlength="5" size="1" value="2"  title="Minor  Alteration" name="alteration_option">
                              Minor  Alteration &nbsp; &nbsp; </td>
                          </tr>
                          <tr>
                            <td colspan="4" align="center" class="text-center"><br>
                              <button id="kurtabtn" class="btn btn-submit" title="Submit" type="submit">Submit</button></td>
                            <input type="hidden" name="action" value="Save Measurement" />
                            <input type="hidden" name="product_id" value="435" />
                          </tr>
                        </table>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                      <div class="row">
                        <div class="col-xs-6 col-sm-12"><img src="<?php echo base_url(); ?>/resources/images/sizeGuide1.jpg" alt="Saree wali size guide"></div>
                        <div class="col-xs-6 col-sm-12"><img src="<?php echo base_url(); ?>/resources/images/sizeGuide2.jpg" alt="Saree wali size guide"></div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
    
    <!-- Product Details Section End -->
    
    <div class="container tabSection">
      <div class="row">
        <div id="horizontalTab">
          <ul class="resp-tabs-list">
            <li id="tab-review"><a href="Specifications">Specifications</a></li>
            <li id="Review2"><a href="reviewsdiv">Review</a></li>
            <li id="tab-review">Review</li>
          </ul>
          <div class="resp-tabs-container">
          <div id="Specifications" class="specifications">
            Specifications
          </div>
            <div id="reviewsdiv">
              <div id="reviewdiv" class="fullwidth reviewarea">
                <h3>Reviews </h3>
                <div class="rvw-artx"> <span class="success"></span>
                  <div id="score-demo"> 
                    <img src="<?php echo base_url(); ?>/resources/images/star-off.png" alt="1" title="bad" id="star1"> 
                    <img src="<?php echo base_url(); ?>/resources/images/star-off.png" alt="2" title="poor" id="star2"> 
                    <img src="<?php echo base_url(); ?>/resources/images/star-off.png" alt="3" title="regular" id="star3"> 
                    <img src="<?php echo base_url(); ?>/resources/images/star-off.png" alt="4" title="good" id="star4"> 
                    <img src="<?php echo base_url(); ?>/resources/images/star-off.png" alt="5" title="gorgeous" id="star5"> 
                  </div>
                </div>
                <ul>
                  <li>
                    <form name="frmReview" id="frmReview">
                      <span class="success"></span> <span class="error"></span>
                      <textarea id="review_description" name="review_description" class="form-control" placeholder="Write a review..."></textarea>
                      <input type="hidden" name="score" value="0" id="score">
                      <input type="hidden" id="product_id" name="product_id" value="435">
                      <input type="submit" name="submit" class="websiteBtn" id="submit-review" value="Submit" />
                      <input type="hidden" action="Submit Review" />
                    </form>
                  </li>
                  <div id="review-content"> </div>
                </ul>
              </div>
            </div>
            <div></div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Tab Details Box End -->
    
    <div class="row">
      <div class="col-md-12 moreThisCollection">
        <div class="moreCollectTitle">
          <h3>More from this Collections</h3>
        </div>
        <div class="row">
          <div id="more-collections" class="owl-carousel">
            
            <div class="item">
              <div class="item-inner">
                <div class="productIconBox"> <a href="javascript:void(0)" onclick="add_cart('118')" data-toggle="tooltip" data-placement="left" title="Add To Cart" ><i aria-hidden="true" class="fa fa-shopping-cart"></i></a> <a href="javascript:void(0)" onclick="add_wishlist('118')" data-toggle="tooltip" data-placement="left" title="Add To Wishlist" ><i aria-hidden="true" class="fa fa-heart-o"></i></a> </div>
                <div class="images-container"><a href="#"><img src="" alt="" ></a></div>
                <div class="productDetailsBtn"><a href="#" title="">View Details</a></div>
              </div>
              <div class="des-container">
                <div class="name"><a href="#">2467 Grey Tussar Silk</a></div>
                <div class="price"> <span><i class="fa fa-inr"></i> 4,600</span> </div>
                <div class="productDetailsBtn"><a href="#" title="">View Details</a></div>
              </div>
            </div>

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

            <div class="item">
              <div class="item-inner">
                <div class="productIconBox"> <a href="javascript:void(0)" onclick="add_cart('118')" data-toggle="tooltip" data-placement="left" title="Add To Cart" ><i aria-hidden="true" class="fa fa-shopping-cart"></i></a> <a href="javascript:void(0)" onclick="add_wishlist('118')" data-toggle="tooltip" data-placement="left" title="Add To Wishlist" ><i aria-hidden="true" class="fa fa-heart-o"></i></a> </div>
                <div class="images-container"><a href="#"><img src="" alt=""></a></div>
                <div class="productDetailsBtn"><a href="#" title="">View Details</a></div>
              </div>
              <div class="des-container">
                <div class="name"><a href="#">2467 Grey Tussar Silk</a></div>
                <div class="price"> <span><i class="fa fa-inr"></i> 4,600</span> </div>
                <div class="productDetailsBtn"><a href="#" title="">View Details</a></div>
              </div>
            </div>

          </div>
        </div>
      </div>

  </div>
  </div>
</section>
<?php echo $footer; ?>
<?php echo $foot; ?>

