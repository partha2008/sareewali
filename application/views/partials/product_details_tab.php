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