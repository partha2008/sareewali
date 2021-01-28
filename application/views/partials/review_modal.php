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