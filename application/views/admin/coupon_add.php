		<?php echo $head; ?>
		
		<div id="wrapper">

			<?php echo $header; ?>

			<div id="page-wrapper" style="min-height: 325px;">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Add Coupon</h1>
					</div>
					<!-- /.col-lg-12 -->
				</div>
				<!-- /.row -->
				<div class="row">
					<div class="col-lg-12">
						<?php $sess_notify = $this->session->userdata('has_error');

						if(isset($sess_notify) & !$sess_notify){?>
						<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<?php echo $this->session->userdata('coupon_notification');?>
						</div>
						<?php } ?>
						<?php if(isset($sess_notify) & $sess_notify){?>
						<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<?php echo $this->session->userdata('coupon_notification');?>
						</div>
						<?php } 
							$this->session->unset_userdata('has_error');
							$this->session->unset_userdata('coupon_notification');						
						?>
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-12">
										<form action="<?php echo base_url('admin/coupon/add_coupon');?>" method="POST" role="form">
											<div class="form-group">
												<label class="control-label">Code <span style="color:#a94442;">*</span></label>
												<input class="form-control" type="text" name="code" placeholder="Enter Code" value="<?php if(isset($coupon_data->code)){echo $coupon_data->code;}?>">
											</div>
											<div class="form-group">
												<label class="control-label">Discount (%) <span style="color:#a94442;">*</span></label>
												<input class="form-control" type="text" name="discount" placeholder="Enter Discount" value="<?php if(isset($coupon_data->discount)){echo $coupon_data->discount;}?>">
											</div>											
											<div class="form-group">
												<label class="control-label">Status</label>
												<label class="radio-inline">
													<input type="radio" name="status" value="Y" <?php if(isset($coupon_data->status)){if($coupon_data->status == 'Y'){echo 'checked';}}else{echo 'checked';}?>>Active
												</label>
												<label class="radio-inline">
													<input type="radio" name="status" value="N" <?php if(isset($coupon_data->status)){if($coupon_data->status == 'N'){echo 'checked';}}?>>Inactive
												</label>
											</div>
											
											<button type="submit" class="btn btn-primary">Save Changes</button>
										</form>
									</div>
									<!-- /.col-lg-6 (nested) -->									
								</div>
								<!-- /.row (nested) -->
							</div>
							<!-- /.panel-body -->
						</div>
						<!-- /.panel -->
					</div>
					<!-- /.col-lg-12 -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.page-wrapper -->
		</div>
		<!-- /#wrapper -->
		
		<?php echo $footer; ?>