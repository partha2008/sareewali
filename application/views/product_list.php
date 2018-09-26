      <?php echo $head; ?>
      <?php echo $header; ?>
      <section class="breadcrumbs">
        <div class="container">
          <?php echo $breadcrumb;?>
        </div>
      </section>
      <section class="page-container">
        <div id="loading">
          <div id="loading-center-absolute">
            <div class="object" id="object_one"></div>
            <div class="object" id="object_two"></div>
            <div class="object" id="object_three"></div>
          </div>
        </div>

        <div class="container">
          <div class="row">
            <?php 
              echo $searchbar;
            ?>
            <div class="col-md-9 innerRight">
              <h1 class="page-title"><?php echo $entity;?></h1>
              <div class="innerBanner"><img src="<?php echo base_url('resources/images/7_web_banner_915X270-01.jpg');?>" class="img-responsive" /></div>
              <div class="coutureBannerBtmTxt"><?php echo $entity;?></div>
              <div class="filterRow"> <span>Sort by : </span>
                <div class="shortByBox">Trending
                  <div class="shortByDropDown">
                    <ul>
                      <li><a href="#" class="active">Newest</a></li>
                      <li><a href="#" >Most popular</a></li>
                      <li><a href="#" >Best Selling</a></li>
                      <li><a href="#" >Price High To Low</a></li>
                      <li><a href="#" >Price Low To High</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="row" id="load_products"><?php echo $products;?></div>
              <div class="ajax-load text-center" style="display:none">
                <p><img src="<?php echo base_url(); ?>resources/images/loader.gif"></p>
              </div>
            </div>
          </div>
        </div>

      </section>
      <?php echo $footer; ?>
      <?php echo $foot; ?>

