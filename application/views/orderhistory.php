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
                    <div class="rTableHead"> Order Number </div>
                    <div class="rTableHead"> Price </div>
                    <div class="rTableHead"> Order Date </div>
                    <div class="rTableHead"> Status </div>
                    <div class="rTableHead"> Order Summary </div>
                  </div>
                  <?php
                    if(!empty($order_data)){
                      foreach ($order_data as $key => $value) { 
                        if($value->order_status == 4){
                          $status = 'Completed';
                        }elseif($value->order_status == 5){
                          $status = 'Cancelled';
                        }
                                            
                  ?>
                  <div class="rTableBody">
                    <div class="rTableCell">#<?php echo $value->orderid;?></div>
                    <div class="rTableCell"> <i class="fa fa-inr" aria-hidden="true"></i><?php echo $value->sub_total;?> </div>
                    <div class="rTableCell"> <?php echo date("d-m-Y", $value->date_added);?> </div>
                    <div class="rTableCell"> <?php echo $status;?> </div>
                    <div class="rTableCell">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text </div>
                  </div>
                  <?php
                      }
                    }
                  ?>
                </div>
                <div class="pagination" style="float:right;"> 
                  <?php echo $pagination; ?>  
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

