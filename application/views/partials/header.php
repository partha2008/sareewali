<header>
  <div class="header-top">
    <div class="container">
      <div class="row">
        <div class="col-md-6"> 
        	<span class="phone">
        		<i class="fa fa-phone"></i> 
        		<a href="tel:<?php echo $admin_profile->contact_no;?>"><?php echo $admin_profile->contact_no;?></a>
        	</span> 
        	<span class="email">
        		<i class="fa fa-envelope-o" aria-hidden="true"></i>
        		<a href="mailto:<?php echo $admin_profile->email;?>"><?php echo $admin_profile->email;?></a>
        	</span> 
        	<span class="socal"> 
        		<a href="<?php echo $general_settings->facebook_page_url;?>" class="fbIcon" target="_blank">
        			<i class="fa fa-facebook" aria-hidden="true"></i>
        		</a> 
        		<!--<a href="#" class="twitterIcon" target="_blank">
        			<i class="fa fa-twitter" aria-hidden="true"></i>
        		</a> 
        		<a href="#" class="gPlusIcon" target="_blank">
        			<i class="fa fa-google-plus" aria-hidden="true"></i>
        		</a> 
        		<a href="#" class="gPlusIcon" target="_blank">
        			<i class="fa fa-instagram" aria-hidden="true"></i>
        		</a>--> 
        	</span> 
        </div>
        <div class="col-md-6">
          <ul class="tb_right">

            <!--<li><a href="javascript:void(0)">INR <i class="fa fa-angle-down" aria-hidden="true"></i></a>

              <ul class="currencyBox">

                <li><a onclick="change_currency('INR')" href="javascript:void(0)" title=""><i class="fa fa-inr" aria-hidden="true"></i> INR</a></li>

                <li><a onclick="change_currency('USD')" href="javascript:void(0)" title=""><i class="fa fa-usd" aria-hidden="true"></i> Dollar</a></li>

                <li><a onclick="change_currency('EUR')" href="javascript:void(0)" title=""><i class="fa fa-eur" aria-hidden="true"></i> Euro</a></li>

                <li><a onclick="change_currency('GBP')" href="javascript:void(0)" title=""><i class="fa fa-gbp" aria-hidden="true"></i> Pound</a></li>

                <li><a onclick="change_currency('BDT')" href="javascript:void(0)" title=""><b>&#x9f3;</b> BDT</a></li>

              </ul>

            </li>-->

            <li> <a href="javascript:void(0)">My Account <i class="fa fa-angle-down" aria-hidden="true"></i></a>

              <ul class="myAccountDrop">

                <li class="currencyMyAccount"><a href="#" title=""><i class="fa fa-angle-down" aria-hidden="true"></i> INR</a></li>

                <?php
                  if($this->defaultdata->is_user_session_active() == 1){
                ?>
                <li><a href="<?php echo base_url('myaccount');?>" title="My Account">My Account</a></li>
                <li><a href="<?php echo base_url('mywishlist');?>" title="My Wishlist">My Wishlist</a></li>
                <li><a href="<?php echo base_url('orderhistory');?>" title="Order History">Order History</a></li>
                <li><a href="<?php echo base_url('logout');?>">Log Out</a></li>
                <?php
                  }else{
                ?>
                <li><a href="javascript:void(0);" onclick="openModal('register');" title="">Register</a></li>

                <li><a href="javascript:void(0);" onclick="openModal('login');" >Log In</a></li>
                <?php
                  }
                ?>
              </ul>

            </li>

            <li class="topCart"><a href="javascript:void(0)"><i class="fa fa-shopping-cart" aria-hidden="true"></i> My Cart (0)</a>

              <ul class="myCartBox">

                <h6 class="subtitle">Recently added item(s) <span class="cartCloe"><i class="fa fa-times-circle" aria-hidden="true"></i></span></h6>

                <p class="cardEmpty">You have no items in your shopping cart.</p>

                <div class="cartAddedBox">

                  <div class="cartTotalPrice"> Total : <span><i class="fa fa-inr"></i>0</span> </div>

                  <div class="buttons"> <a rel="nofollow" title="View my shopping cart" href="#" class="websiteBtn">View cart</a> <a rel="nofollow" title="View my shopping cart" href="#" class="websiteBtn" id="button_goto_cart">Checkout</a> </div>

                </div>

                <!-- cartAddedBox End -->

                

              </ul>

            </li>

          </ul>

        </div>

      </div>

    </div>

  </div>

  <div class="header-area">

    <div class="container">

      <div class="row">

        <div class="col-md-2 logo"><a href="<?php echo base_url(); ?>" title=""><img src="<?php echo base_url(); ?>uploads/logo/logo.png" /></a></div>

        <div class="col-md-10 headerRight">

          <div class="menu-container">

            <div class="menu">
              <?php
                  function printTree($tree) {
                    if(!is_null($tree) && count($tree) > 0) {
                            echo '<ul>';
                            foreach($tree as $node) {
                                $name = explode("_", $node['name']);
                                if(!empty($node['children'])){
                                  if($name[1] == 'Y'){
                                    echo '<li><a class="coutreNav" href="'.base_url('product-list/'.$name[2]).'">'.$name[0].'</a>';
                                  }else{
                                    echo '<li><a href="'.base_url('product-list/'.$name[2]).'">'.$name[0].'</a>';
                                  }                                  
                                }else{
                                  if($name[1] == 'Y'){
                                    echo '<li><a class="coutreNav" href="'.base_url('product-list/'.$name[2]).'">'.$name[0].'</a>';
                                  }else{
                                    echo '<li><a href="'.base_url('product-list/'.$name[2]).'">'.$name[0].'</a>';
                                  }
                                }
                                printTree($node['children']);
                                echo '</li>';
                            }
                            echo '</ul>';
                        }
                    }
                    printTree($final_tree);
                ?>
            </div>

          </div>

          <div class="menu-right"> <span class="search"><a href="javascript:void(0)"><i class="fa fa-search" aria-hidden="true"></i></a>

            <ul class="form-box">

              <form name="frmSearch" id="frmSearch" method="get" action="" class="form-controls">

                <input type="search" name="keyword" id="keyword" placeholder="type your search">

                <button value="submit" type="submit"><i class="fa fa-search"></i></button>

              </form>

            </ul>

            </span> <span class="offer"><a href="products.html">Offers</a></span> </div>

          <div class="clearfix"></div>

        </div>

        <div class="clearfix"></div>

      </div>

    </div>

    <div class="skip-container-mobile">

      <div class="container">

        <ul>

          <li class="mobileList mobielMenu"><a href="javascript:void(0)" title=""><i class="fa fa-bars" aria-hidden="true"></i> <span>Menu</span></a></li>

          <li class="mobileList mobileSearch"><a href="javascript:void(0)" title=""><i class="fa fa-search" aria-hidden="true"></i> <span>Search</span></a></li>

          <li class="mobileList mobileAccount"><a href="javascript:void(0)" title=""><i class="fa fa-list-ul" aria-hidden="true"></i> <span>Account</span></a></li>

          <li class="mobileList mobileCart"><a href="javascript:void(0)" title=""><i class="fa fa-shopping-bag" aria-hidden="true"></i> <span>Cart</span></a></li>

        </ul>

      </div>

    </div>

    <!-- skip-container-mobile end --> 

    

  </div>

  <!-- Header Area End --> 

</header>

<?php
  echo $modal;
?>