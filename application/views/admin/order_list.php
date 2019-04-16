		<?php echo $head;?>
		
		<div id="wrapper">

			<?php echo $header;?>

			<div id="page-wrapper" style="min-height: 374px;">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">List of Orders</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                	<?php 
                		$sess_notify = $this->session->userdata('order_mail_notification');
						if($sess_notify){
					?>
							<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<?php echo $this->session->userdata('order_mail_notification');?>
							</div>
					<?php 
						}
						$this->session->unset_userdata('order_mail_notification');
					?>
                    <div class="panel panel-default">
                        
						<div class="panel-body">
							<div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
							  <div class="row">
								 <div class="col-sm-12">
									<form action="<?php echo base_url('admin/order-list');?>" method="GET" role="form">
										<div id="dataTables-example_filter" class="dataTables_filter">
											<label>Search: <input name="query" type="search" class="form-control input-sm" placeholder="" aria-controls="dataTables-example" id="user-search" value="<?php echo $search_key;?>"></label>
											<button type="submit" class="btn btn-primary">Search</button>
										</div>
									</form>
								 </div>
							  </div>
							  <div class="row">
								 <div class="col-sm-12">
									<table width="100%" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
									   <thead>
										  <tr role="row">
											 <th>Name</th>	
											 <th>Order Id</th>							 
											 <th>Transaction Id</th>
											 <th>Total</th>
											 <th>Payment Type</th>
											 <th>Date</th>
											 <th>Status</th>
											 <th>Action</th>
										  </tr>
									   </thead>
									   <tbody>
									    <?php if(!empty($order_details)){ ?>
										<?php foreach($order_details AS $detail) {?>
										  <tr class="gradeA odd" role="row">
											 <td><?php echo $detail->first_name.' '.$detail->last_name ;?></td>	
											 <td><?php echo $detail->orderid;?></td>	
											 <td><?php echo $detail->transaction_id;?></td>	
											 <td><i class="fa fa-inr"></i><?php echo $detail->grand_total;?></td>	
											 <td><?php echo $detail->payment_type;?></td>	
											 <td><?php echo date("d-m-Y", $detail->date_added);?></td>
											 <?php
											 	if($detail->status == 0){
											 ?>
											 <td><strong style="color:red;">Failed</strong></td>
											 <?php
											 	}else{
											 ?>
											 <td><strong class="<?php echo $this->config->item('order_status')[$detail->order_status]['class'];?>"><?php echo $this->config->item('order_status')[$detail->order_status]['text'];?></strong></td>
											 <?php
											 	}
											 ?>
											 <td class="center">
											 	<?php
											 		if($detail->status == 1){
											 		if($detail->invoice_generated == "N"){
											 	?>
												<a href="<?php echo base_url('admin/order/generate_invoice/'.$detail->order_id);?>" class="btn btn-sm btn-primary" title="Generate Invoice">Generate Invoice</a>&nbsp;
												<?php
													}else{
												?>
												<a href="<?php echo base_url('admin/order/send_invoice/'.$detail->order_id.'/'.$detail->user_id);?>" class="btn btn-sm btn-primary" title="Generate Invoice">Send Invoice</a>&nbsp;<a target="_blank" href="<?php echo base_url('uploads/invoice/'.$detail->invoice_name);?>" class="btn btn-sm btn-primary" title="Generate Invoice">View Invoice</a>&nbsp;
												<?php
													}
												?>
												<a href="<?php echo base_url('admin/order/resend_mail/'.$detail->order_id.'/'.$detail->user_id);?>" class="btn btn-sm btn-primary" title="Resend Order Email">Resend Order Email</a>&nbsp;
												<?php
													}
												?>
												<a href="<?php echo base_url('admin/order-details/'.$detail->order_id);?>" class="btn btn-sm btn-primary" title="View">View</a>
											</td>
										  </tr>
										  <?php } ?>
										  <?php }else{ ?>
										  <tr class="gradeA odd" role="row"><td colspan="7" style="text-align:center;">No records found</td></tr>
										  <?php } ?>
									   </tbody>
									</table>
								 </div>
							  </div>
							 <div class="pagination" style="float:right;">            
								<?php echo $pagination ?>            
							</div>
							</div>
							<!-- /.table-responsive -->
							</div>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
        </div>

		</div>
		<!-- /#wrapper -->
		
		<?php echo $footer; ?>
