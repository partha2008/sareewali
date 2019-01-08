<div class="rTable itemTotaleBox">
    <div class="rTableBody">
      <div class="rTableRow subTotalRow">
        <div class="rTableCell"> Sub-Total </div>
        <div class="rTableCell text-right"> <span><i class="fa fa-inr"></i> <?php echo number_format($sub_total, 2);?></span> </div>
      </div>
      <?php
        if($discount !== 0){
      ?>
      <div class="rTableRow subTotalRow">
        <div class="rTableCell"> Discount (<?php echo $this->session->userdata('active_coupon').'%';?>)</div>
        <div class="rTableCell text-right"> <span><i class="fa fa-inr"></i> <?php echo number_format($discount, 2);?></span> </div>
      </div>
      <?php
        }
      ?>
      <div class="rTableRow grandTotatlRow">
        <div class="rTableCell"> Grand Total </div>
        <div class="rTableCell text-right"> <span><i class="fa fa-inr"></i> <?php echo $grand_total;?></span></div>
      </div>
    </div>
  </div>