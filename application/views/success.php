      <?php echo $head; ?>

      <section class="page-container">

        <div class="container">

          <div class="page-content">
              <div class="no-prd <?php echo ($payment_status) ? 'pay-notify-success' : 'pay-notify-failure'?> ">
             <?php
              if($payment_status){
             ?>
             <div class="swal2-icon swal2-success swal2-animate-success-icon" style="display: flex;">
              <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
               <span class="swal2-success-line-tip"></span>
               <span class="swal2-success-line-long"></span>
               <div class="swal2-success-ring"></div> 
               <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
               <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
              </div>
              <?php
                }else{
              ?>  
              <div class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;"><span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span><span class="swal2-x-mark-line-right"></span></span></div>
              <?php
                }
              ?>
             <div><?php echo $msgTxt;?></div>
             <?php
              if(isset($transaction_id) && $transaction_id){
             ?>
             <div class="sm">Transaction ID: <?php echo $transaction_id;?></div>
             <?php
              }
             ?>
             <a href="<?php echo base_url();?>" class="websiteBtn">OK</a>
           </div>
            </div>
      </div>

    </section>
    <?php echo $foot; ?>

