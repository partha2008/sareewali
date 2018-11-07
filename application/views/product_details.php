<?php echo $head; ?>
<?php echo $header; ?>

<section class="box-content">
  <div class="container">
    <div class="flickity-slider">
      <div class="carousel-promo-strip"> <strong><span style="color:#ffffff;">Flat 20% Off on Everything</span></strong></div>
      <div class="carousel-promo-strip"> <strong><span style="color:#ffffff;">Customize Stitching Available</span></strong></div>
      <div class="carousel-promo-strip"> <strong><span style="color:#ffffff;">World Wide Express Shipping</span></strong></div>
    </div>
  </div>
</section>

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
        
        <!---image--->
        
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
      
        
        <!---image--[end]---> 
        
      </div>
      <div class="product_information">
        <div class="product_column details_boxC">
          <div class="clearall"></div>
          <h1><span><?php echo $product->name;?></span></h1>
          <div class="model_block"> SKU : <span><?php echo $product->sku;?> </span></div>
          <div class="time_to_ship"> Availability: Ship in <span> 2 Days </span> </div>
          <!--<div class="stichnote">Stitching will take 4 to 5 working days extra (if required). </div>-->
          <div class="price">
            <div class="pricetitle"> Price : </div>
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
            <br>
          </div>
          <p><span>Availability :</span> Out of Stock</p>
          <!--<div class="clearall"></div>
          <div class="me_size_block"> <a data-toggle="modal" data-target="#how_to_measure_tbl" href="javascript:void(0);" title="How To Measure" class="inline_auto_measure chart cboxElement"> <i class="fa fa-crop"></i> How To Measure</a> <a data-toggle="modal" data-target="#size_chart_tbl" href="javascript:void(0);" title="Size Chart" class="inline_auto chart cboxElement"> <i class="fa fa-bar-chart"></i> Size Chart</a> </div>-->
        </div>
        <div class="product_column details_box" style="display:none;"> </div>
        <div class="product_column details_box"> 
          <!--// Change for New Measurement--> 
          <!--// Change for New Measurement-->
          <!--<div class="product_details">
            <div class="custom_options_block    parent_0 div_1">
              <h3>
                <label> Blouse </label>
              </h3>
              <div class="measure_radio subdiv_1">
                <label>
                <input type="radio" onclick="loadStdMeasureBlock('8-1','1','0.00')" class="std_measure Omeasure" name="measure[1]" value="8^Unstitched Blouse Blouse|0.00" checked="checked">
                Unstitched Blouse
                <div class="st_value"><span class="WebRupee">Rs</span>0.00</div>
                <br>
                </label>
              </div>
              <div class="measure_radio subdiv_1">
                <label>
                <input type="radio" onclick="loadStdMeasureBlock('15-1','1','700.00')" class="std_measure Omeasure" name="measure[1]" value="15^Standard Blouse Blouse|700.00">
                Standard Blouse
                <div class="st_value"><span class="WebRupee">Rs</span>700.00</div>
                <span class="note_descr"><i class="icon-question-sign tooltip_right question_icon" title="Measure your Garment bust and choose the corresponding size option from the dropdown.If neck style shown in the image is clearly visible, we’ll design it the same way. If not, we'll stitch our standard yet popular round neck design."></i> </span><br>
                </label>
              </div>
              <div class="sub_block std_measure_block_15-1" style="display:none;">
                <select class="required_field  " name="measure[1_88]" data-desc="Bust Size">
                  <option value="">Select Bust Size</option>
                  <option value="Bust Size~34">34"</option>
                  <option value="Bust Size~36">36"</option>
                  <option value="Bust Size~38">38"</option>
                  <option value="Bust Size~40">40"</option>
                  <option value="Bust Size~42">42"</option>
                </select>
              </div>
              <div class="sub_block std_measure_block_15-1" style="display:none;">
                <select class="required_field  " name="measure[1_89]" data-desc="Blouse Length">
                  <option value="">Select Blouse Length</option>
                  <option value="Blouse Length~13">13"</option>
                  <option value="Blouse Length~14">14"</option>
                  <option value="Blouse Length~15">15"</option>
                  <option value="Blouse Length~16">16"</option>
                  <option value="Blouse Length~17">17"</option>
                  <option value="Blouse Length~18">18"</option>
                  <option value="Blouse Length~19">19"</option>
                  <option value="Blouse Length~20">20"</option>
                  <option value="Blouse Length~21">21"</option>
                  <option value="Blouse Length~22">22"</option>
                  <option value="Blouse Length~23">23"</option>
                  <option value="Blouse Length~24">24"</option>
                </select>
              </div>
              <div class="sub_block std_measure_block_15-1" style="display:none;">
                <select class="required_field  " name="measure[1_90]" data-desc="Sleeve Length">
                  <option value="">Select Sleeve Length</option>
                  <option value="Sleeve Length~0">0"</option>
                  <option value="Sleeve Length~1">1"</option>
                  <option value="Sleeve Length~2">2"</option>
                  <option value="Sleeve Length~3">3"</option>
                  <option value="Sleeve Length~4">4"</option>
                  <option value="Sleeve Length~5">5"</option>
                  <option value="Sleeve Length~6">6"</option>
                  <option value="Sleeve Length~7">7"</option>
                  <option value="Sleeve Length~8">8"</option>
                  <option value="Sleeve Length~9">9"</option>
                  <option value="Sleeve Length~10">10"</option>
                  <option value="Sleeve Length~11">11"</option>
                  <option value="Sleeve Length~12">12"</option>
                  <option value="Sleeve Length~13">13"</option>
                  <option value="Sleeve Length~14">14"</option>
                  <option value="Sleeve Length~15">15"</option>
                  <option value="Sleeve Length~16">16"</option>
                  <option value="Sleeve Length~17">17"</option>
                  <option value="Sleeve Length~18">18"</option>
                  <option value="Sleeve Length~19">19"</option>
                  <option value="Sleeve Length~20">20"</option>
                  <option value="Sleeve Length~21">21"</option>
                  <option value="Sleeve Length~22">22"</option>
                  <option value="Sleeve Length~23">23"</option>
                  <option value="Sleeve Length~24">24"</option>
                  <option value="Sleeve Length~25">25"</option>
                </select>
              </div>
              <label>
              <input type="radio" class="Omeasure" onclick="loadCustMeasureBlock('2-1','1')" name="measure[1]" value="2^Customize Blouse Blouse|800.00">
              Customize Blouse
              <div class="st_value"><span class="WebRupee">Rs</span>800.00</div>
              <span class="note_descr"><i class="icon-question-sign tooltip_right question_icon" title="Measurement will be ask after click on add to cart button. Basketic's Tailoring Service - you can customize the exact fit of the garment, its styling and add adornments, all to suit your taste and body type. The measurements can be added after clicking on"></i> </span>
              </label>
              <div class="descr_note descr_note_1"><b>Measurement will be ask after click on add to cart button.</b></div>
              <input type="hidden" name="hide_1" id="hide_1" class="hide_field" value="0">
            </div>
            <div class="custom_options_block    parent_0 div_3">
              <h3>
                <label> Petticoat </label>
              </h3>
              <div class="measure_radio subdiv_3">
                <label>
                <input type="radio" onclick="loadStdMeasureBlock('7-3','3','0.00')" class="std_measure Omeasure" name="measure[3]" value="7^Without Petticoat Petticoat|0.00" checked="checked">
                Without Petticoat
                <div class="st_value"><span class="WebRupee">Rs</span>0.00</div>
                <br>
                </label>
              </div>
              <div class="measure_radio subdiv_3">
                <label>
                <input type="radio" onclick="loadStdMeasureBlock('16-3','3','300.00')" class="std_measure Omeasure" name="measure[3]" value="16^Standard Petticoat Petticoat|300.00">
                Standard Petticoat
                <div class="st_value"><span class="WebRupee">Rs</span>300.00</div>
                <span class="note_descr"><i class="icon-question-sign tooltip_right question_icon" title="Measure your body waist size and choose the corresponding petticoat size option from the dropdown."></i> </span><br>
                </label>
              </div>
              <div class="sub_block std_measure_block_16-3" style="display:none;">
                <select class="required_field  " name="measure[3_91]" data-desc="Around Waist">
                  <option value="">Select Around Waist</option>
                  <option value="Around Waist~30">30"</option>
                  <option value="Around Waist~32">32"</option>
                  <option value="Around Waist~34">34"</option>
                  <option value="Around Waist~36">36"</option>
                  <option value="Around Waist~38">38"</option>
                  <option value="Around Waist~40">40"</option>
                  <option value="Around Waist~42">42"</option>
                  <option value="Around Waist~44">44"</option>
                  <option value="Around Waist~46">46"</option>
                  <option value="Around Waist~48">48"</option>
                  <option value="Around Waist~50">50"</option>
                </select>
              </div>
              <div class="sub_block std_measure_block_16-3" style="display:none;">
                <select class="required_field  " name="measure[3_92]" data-desc="Petticoat Length">
                  <option value="">Select Petticoat Length</option>
                  <option value="Petticoat Length~32">32"</option>
                  <option value="Petticoat Length~34">34"</option>
                  <option value="Petticoat Length~36">36"</option>
                  <option value="Petticoat Length~38">38"</option>
                  <option value="Petticoat Length~40">40"</option>
                  <option value="Petticoat Length~42">42"</option>
                  <option value="Petticoat Length~44">44"</option>
                </select>
              </div>
              <label>
              <input type="radio" class="Omeasure" onclick="loadCustMeasureBlock('5-3','3')" name="measure[3]" value="5^Pre-Stitched Saree Petticoat|900.00">
              Pre-Stitched Saree
              <div class="st_value"><span class="WebRupee">Rs</span>900.00</div>
              <span class="note_descr"><i class="icon-question-sign tooltip_right question_icon" title="Pre-stitched Saree means the Saree is ready pleated and the petticoat is already stitched inside it you just have to wear the Saree like a lehenga and then put the pallu part of it.  Petticoat is an inner worn inside the Saree from waist to bottom, it is "></i> </span>
              </label>
              <div class="descr_note descr_note_3"><b>Measurement will be ask after click on add to cart button.</b></div>
              <input type="hidden" name="hide_3" id="hide_3" class="hide_field" value="0">
            </div>
            <div class="custom_options_block single_ent">
              <label>
              <input type="checkbox" class="Omeasure" name="measure[19]" value="Fall and Edging|99.00">
              Fall and Edging
              <div class="st_value"><span class="WebRupee">Rs</span>99.00</div>
              <br>
              </label>
            </div>
          </div>-->
          
          <div class="more_details right">
            <h3>Product Highlights</h3>
            <div class="description comment more show-read-more">
              <p><?php echo $product->description;?></p>
            </div>
          </div>
          <a class="add_to_compare_icon  " title="Add to Compare" onclick="addToCompare('7547');">Add to Compare</a> </div>
      </div>
      <div class="product_column_right">
        <div class="prorightcart">
          <div class="pincodebox">
            <div class="pintitle">Check COD Availability For India</div>
            <div class="clearall"></div>
            <div class="pincode"> 
              <!--  <span><strong>Check COD Availability:</strong></span><br /><br />-->
              <input type="text" name="zip_code" value="" id="zip_code" size="15" placeholder="Enter your zipcode">
              <a id="button-zipcode" class="button" title="Check COD Availability"><span>Check</span></a>
              <div id="temp_zipcode" style="width:94%;"></div>
            </div>
          </div>
          <div class="clearall"></div>
          <input type="hidden" name="product_id" size="2" value="7547">
          <?php
            if($product->out_of_stock == 'N'){
          ?>
          <div class="addtocartbuttonholder"> 
            <!--// Change for New Measurement--> 
            <a class="add_to_cart_button  quick_cart" onclick="validateLoginRequireField(0);" title="Login" href="javascript:void('0');">
            <div class="add_cart_block ">Add to Cart</div>
            </a> 
            <!--// ------------------> 
          </div>
          <a onclick="QuickBuyNow('');" title="Buy Now" class="button quick_buy_button ">Buy Now</a> 
          <?php
            }else{
          ?>
          <span class="button out-of-stock_button">out of stock</span> 
          <?php
            }
          ?>
          <!-- <div class="paysecure"></div> --> 
          <span class="add_links"> 
          <!--   <div class="moretitle">More Options</div> 
 <a href="#reviews_box" title="Write a Review" class="reviews_inline"><i class="fa fa-commenting-o" aria-hidden="true"></i> Write a Review</a> --> 
          
          <a onclick="addToWishList('7547');" title="Add to Wish List" class="add_to_wishlist"> <i class="fa fa-heart-o" aria-hidden="true"></i> Add to Wishlist</a> <!--<a href="#tab-inquire" class="inquire_now inline_inquire cboxElement" title="Inquire for 7547"> <i class="fa fa-envelope-o" aria-hidden="true"></i> Inquire Now </a>--> </span>
          <div class="clearall"></div>
          
          <div class="clearfix"></div>
            <div class="codBox"> <span>Check COD available</span>
              <div id="pin-panel">
                <div class="errors"></div>
                <div class="successs"></div>
              </div>
              <input id="pin_code" name="pin_code" type="text" placeholder="Enter Pincode">
              <button id="btn-pin" onClick="return available_post_code($('#pin_code').val())">Check</button>
            </div>
            <div class="clearfix"></div>


          
          <div class="order_by_phone">
            <div class="ortitle"> Place Order By Phone / Whatsapp : </div>
            <span class="callord"> <i class="fa fa-phone"></i> <?php echo $admin_profile->contact_no;?></span> 
            <!--<span class="whatsa"><a href="https://api.whatsapp.com/send?phone=919624660066&amp;text=Hey! I m interested in Red And Beige Color Silk And Lycra Saree and Product SKU : 7547"><i class="fa fa-whatsapp"></i> Connect on Whatsapp </a></span> 
            -->
          </div>
          <!--<div class="clearall"></div>
          <div class="sharebutton">
            <div class="addthis_inline_share_toolbox_tipl" data-url="https://www.aasvaa.com/red-and-beige-color-silk-and-lycra-saree-7547" data-title="Red And Beige Color Silk And Lycra Saree" data-description="The fabulous pattern makes this saree from Aasvaa Fashion a classy number to be included in your wardrobe. Red and beige color silk fabrics and net work and lycra pattern saree. Ideal for party, festi..." style="clear: both;">
              <div id="atstbx" class="at-resp-share-element at-style-responsive addthis-smartlayers addthis-animated at4-show" aria-labelledby="at-2761f4a0-89b6-45c2-907a-1a927e30f66c" role="region"><span id="at-2761f4a0-89b6-45c2-907a-1a927e30f66c" class="at4-visually-hidden">AddThis Sharing Buttons</span>
                <div class="at-share-btn-elements"><a role="button" tabindex="1" class="at-icon-wrapper at-share-btn at-svc-facebook" style="background-color: rgb(238, 238, 238); border-radius: 14px;"><span class="at4-visually-hidden">Share to Facebook</span><span class="at-icon-wrapper" style="line-height: 32px; height: 32px; width: 32px;">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img" aria-labelledby="at-svg-facebook-1" class="at-icon at-icon-facebook" style="fill: rgb(102, 102, 102); width: 32px; height: 32px;">
                    <title id="at-svg-facebook-1">Facebook</title>
                    <g>
                      <path d="M22 5.16c-.406-.054-1.806-.16-3.43-.16-3.4 0-5.733 1.825-5.733 5.17v2.882H9v3.913h3.837V27h4.604V16.965h3.823l.587-3.913h-4.41v-2.5c0-1.123.347-1.903 2.198-1.903H22V5.16z" fill-rule="evenodd"></path>
                    </g>
                  </svg>
                  </span></a><a role="button" tabindex="1" class="at-icon-wrapper at-share-btn at-svc-twitter" style="background-color: rgb(238, 238, 238); border-radius: 14px;"><span class="at4-visually-hidden">Share to Twitter</span><span class="at-icon-wrapper" style="line-height: 32px; height: 32px; width: 32px;">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img" aria-labelledby="at-svg-twitter-2" class="at-icon at-icon-twitter" style="fill: rgb(102, 102, 102); width: 32px; height: 32px;">
                    <title id="at-svg-twitter-2">Twitter</title>
                    <g>
                      <path d="M27.996 10.116c-.81.36-1.68.602-2.592.71a4.526 4.526 0 0 0 1.984-2.496 9.037 9.037 0 0 1-2.866 1.095 4.513 4.513 0 0 0-7.69 4.116 12.81 12.81 0 0 1-9.3-4.715 4.49 4.49 0 0 0-.612 2.27 4.51 4.51 0 0 0 2.008 3.755 4.495 4.495 0 0 1-2.044-.564v.057a4.515 4.515 0 0 0 3.62 4.425 4.52 4.52 0 0 1-2.04.077 4.517 4.517 0 0 0 4.217 3.134 9.055 9.055 0 0 1-5.604 1.93A9.18 9.18 0 0 1 6 23.85a12.773 12.773 0 0 0 6.918 2.027c8.3 0 12.84-6.876 12.84-12.84 0-.195-.005-.39-.014-.583a9.172 9.172 0 0 0 2.252-2.336" fill-rule="evenodd"></path>
                    </g>
                  </svg>
                  </span></a><a role="button" tabindex="1" class="at-icon-wrapper at-share-btn at-svc-pinterest_share" style="background-color: rgb(238, 238, 238); border-radius: 14px;"><span class="at4-visually-hidden">Share to Pinterest</span><span class="at-icon-wrapper" style="line-height: 32px; height: 32px; width: 32px;">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img" aria-labelledby="at-svg-pinterest_share-3" class="at-icon at-icon-pinterest_share" style="fill: rgb(102, 102, 102); width: 32px; height: 32px;">
                    <title id="at-svg-pinterest_share-3">Pinterest</title>
                    <g>
                      <path d="M7 13.252c0 1.81.772 4.45 2.895 5.045.074.014.178.04.252.04.49 0 .772-1.27.772-1.63 0-.428-1.174-1.34-1.174-3.123 0-3.705 3.028-6.33 6.947-6.33 3.37 0 5.863 1.782 5.863 5.058 0 2.446-1.054 7.035-4.468 7.035-1.232 0-2.286-.83-2.286-2.018 0-1.742 1.307-3.43 1.307-5.225 0-1.092-.67-1.977-1.916-1.977-1.692 0-2.732 1.77-2.732 3.165 0 .774.104 1.63.476 2.336-.683 2.736-2.08 6.814-2.08 9.633 0 .87.135 1.728.224 2.6l.134.137.207-.07c2.494-3.178 2.405-3.8 3.533-7.96.61 1.077 2.182 1.658 3.43 1.658 5.254 0 7.614-4.77 7.614-9.067C26 7.987 21.755 5 17.094 5 12.017 5 7 8.15 7 13.252z" fill-rule="evenodd"></path>
                    </g>
                  </svg>
                  </span></a><a role="button" tabindex="1" class="at-icon-wrapper at-share-btn at-svc-google_plusone_share" style="background-color: rgb(238, 238, 238); border-radius: 14px;"><span class="at4-visually-hidden">Share to Google+</span><span class="at-icon-wrapper" style="line-height: 32px; height: 32px; width: 32px;">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img" aria-labelledby="at-svg-google_plusone_share-4" class="at-icon at-icon-google_plusone_share" style="fill: rgb(102, 102, 102); width: 32px; height: 32px;">
                    <title id="at-svg-google_plusone_share-4">Google+</title>
                    <g>
                      <path d="M12 15v2.4h3.97c-.16 1.03-1.2 3.02-3.97 3.02-2.39 0-4.34-1.98-4.34-4.42s1.95-4.42 4.34-4.42c1.36 0 2.27.58 2.79 1.08l1.9-1.83C15.47 9.69 13.89 9 12 9c-3.87 0-7 3.13-7 7s3.13 7 7 7c4.04 0 6.72-2.84 6.72-6.84 0-.46-.05-.81-.11-1.16H12zm15 0h-2v-2h-2v2h-2v2h2v2h2v-2h2v-2z" fill-rule="evenodd"></path>
                    </g>
                  </svg>
                  </span></a></div>
              </div>
            </div>
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5b712169df9eee01"></script> 
          </div>-->
        </div>
        <!--<div class="prodoffer">
          <div class="offerdetail">
            <div id="offertext">
              <div class="offers_list">
                <div class="offer">
                  <h4>Offers Alert</h4>
                  <h4 style="text-align: center; font-size: 18px; margin-top: 0px; margin-bottom: 10px; color: rgb(0, 0, 0); font-family: &quot;Source Sans Pro&quot;, Arial, Helvetica, sans-serif;"> <span style="color:#ff8c00;">: Instant Discount :</span></h4>
                  <ul style="font-size: 14px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;">
                    <li style=""> <span style="font-family:georgia,serif;"><strong style=""><font color="#666666" style="color: rgb(0, 0, 0);"><strong><font color="#666666">Buy&nbsp;</font><span style="color: rgb(0, 128, 0);"><strong><span style="color: rgb(204, 51, 102);">1</span></strong>&nbsp;</span><font color="#666666">Get</font></strong>&nbsp;</font></strong><strong style="font-family: &quot;comic sans ms&quot;, cursive;"><span style="color: rgb(204, 51, 102);">10% OFF</span></strong></span></li>
                    <li style=""> <span style="font-family:georgia,serif;"><strong style=""><font color="#666666">Buy&nbsp;</font><span style="color: rgb(0, 128, 0);"><strong><span style="color: rgb(204, 51, 102);">2</span></strong>&nbsp;</span><font color="#666666">Get&nbsp;</font><span style="color:#cc3366;">15% OFF</span></strong></span></li>
                    <li style=""> <span style="font-family:georgia,serif;"><strong style=""><font color="#666666">Buy&nbsp;</font><font color="#008000"><strong><font color="#666666"><strong><span style="color: rgb(204, 51, 102);">3</span></strong>&nbsp;and More</font></strong></font><font color="#666666">&nbsp;Get&nbsp;</font></strong><strong style="font-family: &quot;comic sans ms&quot;, cursive;"><span style="color: rgb(204, 51, 102);">20% OFF</span></strong></span></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>-->
      </div>
      <div class="clearall"></div>
      <div id="tab-inquire" class="tab-content prodinq" style="display:none;">
        <div class="space20px"></div>
        <!-- <div class="inquiry_title">Inquire 7547</div> -->
        <div id="inquire"></div>
        <table cellpadding="0" cellspacing="0" border="0" style="margin-bottom:10px;">
          <tbody>
            <tr>
              <td valign="top"><input style="width:183px;" type="text" placeholder="Name:" name="name_inquire" value="">
                <div id="warn_name_inquire" class="formerror11"></div></td>
              <td valign="top"><input style="width:180px;" type="text" placeholder="Mobile/Whatsapp" name="phone_inquire" value="">
                <div id="warn_phone_inquire" class="formerror11"></div></td>
              <td valign="top"><input style="width:183px;" type="text" placeholder="Email Address:" name="email_inquire" value="">
                <div id="warn_email_inquire" class="formerror11"></div></td>
            </tr>
          </tbody>
        </table>
        <textarea placeholder="Comment" cols="40" rows="8" style="width: 92%; margin-bottom: 20px;" name="comment_inquire"></textarea>
        <div id="warn_comment_inquire" class="formerror11"></div>
        <input type="text" name="captcha_inquire" value="" placeholder="Enter the code in the box below:" class="cpt">
        <div class="formerror11" id="warn_captcha_inquire"></div>
        <br>
        <img src="index.php?route=product/product/captcha" alt="Red And Beige Color Silk And Lycra Saree" id="captcha"><br>
        <div class="buttons">
          <div class="left"><a id="button-inquire" class="button">Submit</a></div>
        </div>
        <br>
        <br>
        <div class="space20px"></div>
      </div>
      <div class="clearall"></div>
    </div>
  </div>
  <div class="tab_div bg">
    <table width="100%">
      <tbody>
        <tr>
          <td valign="top" width="100%"><div>
              <div class="product_page_tabs">
                <div id="notetabs" class="notestab"> <a href="#tab-more-details" class="selected">Product Info</a> <a href="#tab-notes">Notes</a> <a href="#tab-shipping_policy_tab">Shipping Policy</a> <a href="#tab-payment_policy_tab">Payment Policy</a> <a href="#tab-cashback_policy_tab">Cashback Policy</a> <a href="#tab-review">Reviews</a> </div>
                <div id="tab-more-details" class="tab-content" style="display: block;">
                  <div class="more_details"> <a href="https://www.aasvaa.com/sarees&amp;catalog=3053"></a><a href="https://www.aasvaa.com/sarees&amp;colors=orange"></a><a href="https://www.aasvaa.com/sarees&amp;colors=beige"></a><a href="https://www.aasvaa.com/sarees&amp;work=embroidered"></a><a href="https://www.aasvaa.com/sarees&amp;style=half-n-half-saree"></a><a href="https://www.aasvaa.com/sarees&amp;fabric=silk"></a><a href="https://www.aasvaa.com/sarees&amp;occasion=party"></a><a href="https://www.aasvaa.com/sarees&amp;shipping_time=2-days"></a><a href="https://www.aasvaa.com/sarees&amp;product_content=saree"></a><a href="https://www.aasvaa.com/sarees&amp;product_content=unstitched-blouse"></a>
                    <table width="100%">
                      <tbody>
                        <tr>
                          <td class="variation_td"><div> <span class="variation_name">Product Code</span>: <?php echo $product->sku;?></div></td>
                        </tr>
                        <tr>
                          <td class="variation_td"><div><span class="variation_name">Colors</span>: <?php echo $product_color;?> </div></td>
                        </tr>
                        <tr>
                          <td class="variation_td"><div><span class="variation_name">Fabric</span>: <a href="https://www.aasvaa.com/sarees&amp;fabric=silk">Silk</a> </div></td>
                        </tr>
                        <tr>
                          <td class="variation_td"><div><span class="variation_name">Occasion</span>: <a href="https://www.aasvaa.com/sarees&amp;occasion=party">Party</a> </div></td>
                        </tr>
                        <tr>
                          <td class="variation_td"><div><span class="variation_name">Content</span>: <a href="https://www.aasvaa.com/sarees&amp;product_content=saree">Saree</a>, <a href="https://www.aasvaa.com/sarees&amp;product_content=unstitched-blouse">Unstitched Blouse</a> </div></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div id="tab-notes" class="tab-content" style="display: none;">
                  <ul>
                    <li><span>The first wash of the garment should always be Dry-Cleaned.</span></li>
                    <li> <span>The shades may vary slightly from the colors displayed on your screen.</span></li>
                    <li> <span>There might be slight color variation due to lightings &amp; flash while photo shoot.</span></li>
                    <li> <span>The bright shade seen is the best closer view of fabric's color</span></li>
                  </ul>
                </div>
                
                
                <div id="tab-shipping_policy_tab" class="tab-content" style="display: none;">
                
                
                  <div><strong>Shipping Outside India / International</strong></div>
                  
                  <ul>
                    <li><strong>Shipping Time</strong></li>
                  </ul>
                  <div>05 - 10 Business days for Un-Stitched product.</div>
                  <div style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;"> &nbsp;</div>
                  <div><span style="font-family:arial,helvetica,sans-serif;"><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; # </strong>04 - 05&nbsp;</span></span><span style="font-family: arial, helvetica, sans-serif;">Extra</span><span style="font-family: arial, helvetica, sans-serif;">&nbsp;Business days for Custom Stitched product.</span></div>
                  <ul>
                    <li style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;"> <span style="font-family:georgia,serif;"><span style="font-size:12px;"><strong>Shipping Cost</strong></span></span></li>
                  </ul>
                  <div style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;"> <span style="font-size:12px;"><span style="font-family:arial,helvetica,sans-serif;"><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;#</strong>&nbsp;Shipping Cost is calculated on per product and Based on S</span><span style="font-family: arial, helvetica, sans-serif;">electing Your Country&nbsp;Location ,which will be reflected on your Cart &amp; checkout page.</span></span></div>
                  <div style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;"> &nbsp;</div>
                  <div style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;"> <span style="font-size:12px;"><span style="font-family:arial,helvetica,sans-serif;"><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;#&nbsp;</strong>Base Shipping cost is $15 worldwide for the first product and $8 extra for every additional product added. Shipping is FREE for orders above $249.</span></span></div>
                  <ul>
                    <li style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;"> <span style="font-family:georgia,serif;"><strong>Shipping Services&nbsp;</strong></span><strong style="font-family: georgia, serif;">Location</strong></li>
                  </ul>
                  <p style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;"> <strong style="font-family: arial, helvetica, sans-serif;">&nbsp; &nbsp; &nbsp; &nbsp; #</strong><span style="font-family: arial, helvetica, sans-serif;">&nbsp;80 + Countries worldwide including US, UK, Canada, Australia, New Zealand and More.</span></p>
                  <p style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;"> <u><strong style="font-family: georgia, serif; font-size: 14px;">Shipping Inside India</strong></u></p>
                  <div style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;"> <span style="font-size:12px;"><span style="font-family:arial,helvetica,sans-serif;"><strong>&nbsp; &nbsp; &nbsp; &nbsp; #&nbsp;</strong>Free Shipping all Location in India.</span></span></div>
                  <div style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;"> &nbsp;</div>
                  <p style="margin-top: 0px; margin-bottom: 20px; color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;"> <strong style="font-family: georgia, serif;">Tip - Shipping cost decreases when you buy more than two products. Buy more, Save more!</strong></p>
                  
                  
                  
                  
                  
                  
                </div>
                
                
                
                
                
                
                
                
                
                
                <div id="tab-payment_policy_tab" class="tab-content" style="display: none;">
                  <p style="margin-top: 0px; margin-bottom: 20px; color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;"> <span style="font-size:12px;"><strong style="font-family: georgia, serif;">You can choose from any of the following modes to make payment for your purchases on&nbsp;<a href="https://www.aasvaa.com/" style="text-decoration-line: none; color: rgb(51, 51, 51); cursor: pointer;">aasvaa.com</a></strong></span></p>
                  <ul style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;">
                    <li> <span style="font-size:12px;"><span style="font-family:arial,helvetica,sans-serif;"><span style="font-family:georgia,serif;"><strong>COD :</strong></span>&nbsp;Cash on Delivery, where you can pay by Cash on receipt of product.<span style="color:#a9a9a9;"> (India Only.)</span></span></span></li>
                  </ul>
                  <ul style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;">
                    <li> <span style="font-size:12px;"><span style="font-family: arial, helvetica, sans-serif;"><span style="font-family: georgia, serif;"><strong>Direct Bank Transfer :</strong></span>&nbsp;Pay via Bank Transfer.&nbsp;</span><span style="color:#a9a9a9;">(India &amp; International.)</span></span></li>
                  </ul>
                  <ul style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;">
                    <li> <span style="font-size:12px;"><span style="font-family:arial,helvetica,sans-serif;"><span style="font-family:georgia,serif;"><strong>Net banking :</strong></span>&nbsp;All the major banks. Details available at Checkout.</span></span></li>
                  </ul>
                  <ul style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;">
                    <li> <span style="font-size:12px;"><span style="font-family:arial,helvetica,sans-serif;"><span style="font-family:georgia,serif;"><strong>Domestic Payment Gateway :</strong></span>&nbsp;EBS, Ccavenue(All Mesure Card Accepted).&nbsp;</span><span style="color:#a9a9a9;">(India Only.)</span></span></li>
                  </ul>
                  <ul style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;">
                    <li> <span style="font-size:12px;"><span style="font-family:arial,helvetica,sans-serif;"><span style="font-family:georgia,serif;"><strong>EBS International Gateway :</strong></span>&nbsp;Credir Card, Debit Card, Master card, Visa Card, Discover, JCB, American Express, Diners Club cards and Maestro cards.&nbsp;</span><span style="color:#a9a9a9;">(International Only.)</span></span></li>
                  </ul>
                  <ul style="color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif;">
                    <li> <span style="font-size:12px;"><span style="font-family:arial,helvetica,sans-serif;"><span style="font-family:georgia,serif;"><strong>PayPal&nbsp;<strong>International Gateway&nbsp;</strong>:&nbsp;</strong></span>(Transfer from PayPal Account or pay Via Credit Card/ Debit Card using PayPal) ( PayPal is only for international Payments)&nbsp;</span><span style="color:#a9a9a9;">(International Only.)</span></span></li>
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
                  <!-- <div class="reviewtag"> -->
                  <div class="tab-reviews">
                    <div class="box-heading">
                      <h2>Reviews</h2>
                    </div>
                    <!--     <div class="title">Reviews</div>-->
                    <div id="">
                      <div id="review">
                        <?php
                          if(empty($reviews)){
                            echo '<div class="content">There are no reviews for this product.</div>';
                          }else{
                        ?>
                        <!----review-Comment-------->
                        <div class="card">
                            <div class="card-body">
                              <?php
                                foreach ($reviews as $key => $value) {
                              ?> 
                              <div class="card card-inner">
                                  <div class="card-body">
                                      <div class="row">
                                          <div class="col-sm-1">
                                              <img src="https://www.sareewali.com/resources/images/def_face.jpg" class="img img-rounded img-fluid"/>
                                          </div>
                                          <div class="col-sm-10">
                                              <p><a href="#"><strong><?php echo $value->reviewer;?></strong></a>
                                              	<span class="text-secondary date-block"><?php echo $this->defaultdata->time_elapsed_string('@'.$value->date_added);?></span>
                                              </p>                                               
                                              <p><?php echo $value->review;?></p>
                                              <!--<p>
                                                  <a class="float-right btn btn-outline-primary ml-2">  <i class="fa fa-reply"></i> Reply</a>
                                                  <a class="float-right btn text-white btn-danger"> <i class="fa fa-heart"></i> Like</a>
                                              </p>-->
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
    					         <!----review-Comment----[end]---->
                        <?php
                          }
                        ?>    
                      </div>
                    </div>
                    <a data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#reviews_box" href="javascript:void(0);" title="Write a Review" class="reviews_inline button cboxElement">Write a Review</a> </div>
                  <!--  </div> --> 
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
              <div class="productIconBox"> <a href="javascript:void(0)" onclick="add_cart('')" data-toggle="tooltip" data-placement="left" title="Add To Cart" ><i aria-hidden="true" class="fa fa-shopping-cart"></i></a> <a href="javascript:void(0)" onclick="add_wishlist('')" data-toggle="tooltip" data-placement="left" title="Add To Wishlist" ><i aria-hidden="true" class="fa fa-heart-o"></i></a> </div>
              <div class="images-container"><a href="<?php echo base_url('product-details/'.$value->slug);?>"><img src="<?php echo UPLOAD_PRODUCT_PATH.pathinfo($value->prd_img_name, PATHINFO_FILENAME).'_l.'.pathinfo($value->prd_img_name, PATHINFO_EXTENSION);?>" alt="<?php echo $value->prd_name;?>"></a></div>
              <div class="productDetailsBtn"><a href="<?php echo base_url('product-details/'.$value->slug);?>" title="<?php echo $value->prd_name;?>">View Details</a></div>
            </div>
            <div class="des-container">
              <div class="name"><a href="<?php echo base_url('product-details/'.$value->slug);?>"><?php echo $value->prd_name;?></a></div>
              <?php
                if($value->prd_dic_chk == "Y"){
              ?>
              <div class="price"> <span><i class="fa fa-inr"></i> <?php echo $value->discounted_price;?></span> </div>
              <?php
                }else{
              ?>
              <div class="price"> <span><i class="fa fa-inr"></i> <?php echo $value->price;?></span> </div>
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
              <div class="productIconBox"> <a href="javascript:void(0)" onclick="add_cart('')" data-toggle="tooltip" data-placement="left" title="Add To Cart" ><i aria-hidden="true" class="fa fa-shopping-cart"></i></a> <a href="javascript:void(0)" onclick="add_wishlist('')" data-toggle="tooltip" data-placement="left" title="Add To Wishlist" ><i aria-hidden="true" class="fa fa-heart-o"></i></a> </div>
              <div class="images-container"><a href="<?php echo base_url('product-details/'.$value->slug);?>"><img src="<?php echo UPLOAD_PRODUCT_PATH.pathinfo($value->prd_img_name, PATHINFO_FILENAME).'_l.'.pathinfo($value->prd_img_name, PATHINFO_EXTENSION);?>" alt="<?php echo $value->prd_name;?>"></a></div>
              <div class="productDetailsBtn"><a href="<?php echo base_url('product-details/'.$value->slug);?>" title="<?php echo $value->prd_name;?>">View Details</a></div>
            </div>
            <div class="des-container">
              <div class="name"><a href="<?php echo base_url('product-details/'.$value->slug);?>"><?php echo $value->prd_name;?></a></div>
              <?php
                if($value->prd_dic_chk == "Y"){
              ?>
              <div class="price"> <span><i class="fa fa-inr"></i> <?php echo $value->discounted_price;?></span> </div>
              <?php
                }else{
              ?>
              <div class="price"> <span><i class="fa fa-inr"></i> <?php echo $value->price;?></span> </div>
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

 <!-- Modal -->
  <div class="modal fade" id="how_to_measure_tbl" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div style="padding: 10px;">
                <div class="images-box scroll-box" style="height: 450px; overflow-y: scroll; padding: 10px 5px; max-width: 100%; text-align: center; color: rgb(68, 68, 68); font-family: Lato, Arial, Helvetica, sans-serif; font-size: 13px;">
                  <div class="img-responsive">
                    <p align="center" style="margin-top: 0px; margin-bottom: 20px;"> <strong><span style="font-family:georgia,serif;"><span style="font-size:18px;"><span style="color:#ffa500;"><span style="background-color:#ffffff;">How to Measure Saree Blouse</span></span></span></span></strong></p>
                    <p align="center" style="margin-top: 0px; margin-bottom: 20px;"> <strong><img alt="" src="http://www.aasvaa.com/image/data/measurement/blouse-measure-tips-how-to-measure.jpg" style="width: 400px; height: 368px;"></strong></p>
                    <div class="content">
                      <h4 style="font-size: 18px; margin: 0px 0px 10px;"> <u>Important Notes while taking measurement:</u></h4>
                      <p style="margin-top: 0px; margin-bottom: 10px; color: rgb(102, 102, 102); font-size: 14px; line-height: 23px; text-align: justify;"> 1. Please follow the instructions below to get your exact body size and then compare it to our body measurement chart to see which size fits you best.</p>
                      <p style="margin-top: 0px; margin-bottom: 10px; color: rgb(102, 102, 102); font-size: 14px; line-height: 23px; text-align: justify;"> 2. Keep Measurement tape firm, but not tight.</p>
                      <p style="margin-top: 0px; margin-bottom: 10px; color: rgb(102, 102, 102); font-size: 14px; line-height: 23px; text-align: justify;"> 3. Ask someone to assist you while taking measurement.</p>
                      <p style="margin-top: 0px; margin-bottom: 10px; color: rgb(102, 102, 102); font-size: 14px; line-height: 23px; text-align: justify;"> Bust: Measure the fullest part of your bust while keeping the measurement tape a bit loose.</p>
                      <p style="margin-top: 0px; margin-bottom: 10px; color: rgb(102, 102, 102); font-size: 14px; line-height: 23px; text-align: justify;"> Around Above Waist: Measure it between the ribcage &amp; above the navel or at 15 inches from the shoulder point.</p>
                      <p style="margin-top: 0px; margin-bottom: 10px; color: rgb(102, 102, 102); font-size: 14px; line-height: 23px; text-align: justify;"> Blouse Length: Measure length from the shoulder point to your desired length like shown in the image</p>
                    </div>
                  </div>
                </div>
                <p>&nbsp; </p>
              </div>
        </div>
      </div>
      
    </div>
  </div>

    <!-- Modal -->
  <div class="modal fade" id="size_chart_tbl" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p><img alt="" src="https://www.aasvaa.com/image/data/sizechart/sizes-002.jpg" style="width: 634px; height: 585px;"></p>
        </div>
      </div>
      
    </div>
  </div>

  <!-- Modal -->

  <div class="modal fade" id="reviews_box" role="dialog">
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div id="tab-review">
            <div id="review-title"></div>
            <div id="review_write_box">
              <form id="review_frm">
                <div class="error" style="display:none;"></div>
                <div class="success" style="display:none;"></div>
                <table>
                  <tbody>
                    <tr>
                      <td><input type="text" name="reviewer" value="" placeholder="Name:"></td>
                      <td><input type="text" name="email" value="" placeholder="Email Address:"></td>
                    </tr>
                    <tr>
                      <td><input type="text" name="phone" value="" placeholder="Phone"></td>
                      <td>
                        <select name="state_id" class="span4fordrop">
                          <option value="">State</option>
                          <?php
                            if(!empty($state_data)){
                              foreach ($state_data as $key => $value) {
                                echo '<option value="'.$value->state_id.'">'.$value->name.'</option>';
                              }
                            }
                          ?>                                  
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2"><textarea name="review" cols="40" rows="5" style="width: 97%;" placeholder="Review:"></textarea>
                        <span style="font-size: 11px;"><span style="color: #FF0000;">Note:</span> HTML is not translated!</span><br>
                        <br>
                        <b>Rating:</b> <span>Bad</span>&nbsp;
                        <input type="radio" name="rating" value="1">
                        &nbsp;
                        <input type="radio" name="rating" value="2">
                        &nbsp;
                        <input type="radio" name="rating" value="3">
                        &nbsp;
                        <input type="radio" name="rating" value="4">
                        &nbsp;
                        <input type="radio" name="rating" value="5">
                        &nbsp; <span>Good</span> <br>
                        
                        <br>
                        <div class="g-recaptcha" data-sitekey="6LcQeXcUAAAAAPcz5GT8d8lUhMgn5iFyILhuhWuV"></div>
                        <br>
                        <br>
                        <div class="buttons">
                          <div class="left"><button type="submit" id="button-review" class="button">Continue</button></div>
                        </div></td>
                        <input type="hidden" name="product_id" value="<?php echo $product->product_id;?>">
                    </tr>
                  </tbody>
                </table>
              </form>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
      
<?php echo $footer; ?>
<?php echo $foot; ?>