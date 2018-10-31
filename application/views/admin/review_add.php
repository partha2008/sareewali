		<?php echo $head; ?>
		
		<div id="wrapper">

			<?php echo $header; ?>

			<div id="page-wrapper" style="min-height: 325px;">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Add Review</h1>
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
							<?php echo $this->session->userdata('review_notification');?>
						</div>
						<?php } ?>
						<?php if(isset($sess_notify) & $sess_notify){?>
						<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<?php echo $this->session->userdata('review_notification');?>
						</div>
						<?php } 
							$this->session->unset_userdata('has_error');
							$this->session->unset_userdata('review_notification');						
						?>
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-12">
										<form action="<?php echo base_url('admin/review/add_review');?>" method="POST" role="form" enctype="multipart/form-data">
											<div class="form-group">
												<label class="control-label">Name <span style="color:#a94442;">*</span></label>
												<input class="form-control" type="text" name="reviewer" placeholder="Enter Name" value="<?php if(isset($review_data->reviewer)){echo $review_data->reviewer;}?>">
											</div>
											<div class="form-group">
												<label class="control-label">Email <span style="color:#a94442;">*</span></label>
												<input class="form-control" type="text" name="email" placeholder="Enter Email" value="<?php if(isset($review_data->email)){echo $review_data->email;}?>">
											</div>
											<div class="form-group">
												<label class="control-label">Phone <span style="color:#a94442;">*</span></label>
												<input class="form-control" type="text" name="phone" placeholder="Enter Phone" value="<?php if(isset($review_data->phone)){echo $review_data->phone;}?>">
											</div>
											<div class="form-group">
												<label class="control-label">State <span style="color:#a94442;">*</span></label>
												<select name="state_id" class="form-control">
													<option value="">Select State</option>
													<?php
														if(!empty($state_data)){
															foreach ($state_data as $key => $value) {
																if($review_data->state_id == $value->state_id){
																	echo '<option selected value="'.$value->state_id.'">'.$value->name.'</option>';
																}else{
																	echo '<option value="'.$value->state_id.'">'.$value->name.'</option>';
																}		
															}
														}
													?>
												</select>
											</div>
											<div class="form-group">
												<label class="control-label">Review <span style="color:#a94442;">*</span></label>
												<textarea name="review" class="form-control" placeholder="Enter Review"><?php echo (isset($review_data->review) && $review_data->review) ? $review_data->review : '';?></textarea>
											</div>
											<div class="form-group">
												<label class="control-label">Product <span style="color:#a94442;">*</span></label>
												<select name="product_id" class="form-control">
													<option value="">Select Product</option>
													<?php
														if(!empty($product_data)){
															foreach ($product_data as $key => $value) {
																if($review_data->product_id == $value->product_id){
																	echo '<option selected value="'.$value->product_id.'">'.$value->name.'</option>';
																}else{
																	echo '<option value="'.$value->product_id.'">'.$value->name.'</option>';
																}		
															}
														}
													?>
												</select>
											</div>
											<div class="form-group">
												<label class="control-label">Rating <span style="color:#a94442;">*</span></label>
												<select name="rating" class="form-control">
													<option value="">Select Rating</option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
												</select>
											</div>
											<div class="form-group">
												<label class="control-label">Status</label>
												<label class="radio-inline">
													<input type="radio" name="status" value="Y" <?php if(isset($review_data->status)){if($review_data->status == 'Y'){echo 'checked';}}else{echo 'checked';}?>>Active
												</label>
												<label class="radio-inline">
													<input type="radio" name="status" value="N" <?php if(isset($review_data->status)){if($review_data->status == 'N'){echo 'checked';}}else{echo 'checked';}?>>Inactive
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