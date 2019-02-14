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
        <h1 class="page-title">Order History</h1>
          <div class="row">
          <?php 
            echo $sidebar;
          ?>
            <div class="col-md-9 orderHistory">
              <div style="overflow-x:auto">
                <div class="rTable">
                  <div class="rTableHeading">
                    <div class="rTableHead"> &nbsp; </div>
                    <div class="rTableHead"> Product </div>
                    <div class="rTableHead"> Order Number </div>
                    <div class="rTableHead"> Price </div>
                    <div class="rTableHead"> Order Date </div>
                    <div class="rTableHead"> Status </div>                    
                  </div>
                  <?php
                    if(!empty($order_data)){
                      foreach ($order_data as $key => $value) {  
                  ?>
                  <div class="rTableBody">
                    <div class="rTableCell"><img src="<?php echo UPLOAD_PRODUCT_PATH.pathinfo($value['prd_name'], PATHINFO_FILENAME).'_s.'.pathinfo($value['prd_name'], PATHINFO_EXTENSION);?>"></div>
                    <div class="rTableCell"><?php echo $value['name'];?></div>
                    <div class="rTableCell">#<?php echo $value['orderid'];?></div>
                    <div class="rTableCell"> <i class="fa fa-inr" aria-hidden="true"></i> <?php echo $value['sub_total'];?> </div>
                    <div class="rTableCell"> <?php echo date("d-m-Y", $value['date_added']);?> </div>
                    <div class="rTableCell"> <?php echo $this->config->item('order_status')[$value['order_status']]['text'];?> </div>
                  </div>
                  <?php
                      }
                    }
                  ?>
                </div>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
      </div>
    </div> 
  </section>
  
  <?php echo $footer; ?>
  <?php echo $foot; ?>

