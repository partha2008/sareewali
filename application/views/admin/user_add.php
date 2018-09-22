	<?php echo $head; ?>
	
	<div id="wrapper">

		<?php echo $header; ?>

		<div id="page-wrapper" style="min-height: 325px;">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Add User</h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-lg-12">						
					<?php 
						$sess_notify = $this->session->userdata('has_error');
						if(isset($sess_notify) & $sess_notify){
					?>
						<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<?php echo $this->session->userdata('useradd_notification');?>
						</div>
					<?php } 
					$this->session->unset_userdata('has_error');
					$this->session->unset_userdata('useradd_notification');
					?>
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
									<form action="<?php echo base_url('admin/user/add_user');?>" method="POST" role="form" novalidate>
										<div class="form-group">
											<label class="control-label">First Name <span style="color:#a94442;">*</span></label>
											<input class="form-control" type="text" name="first_name" placeholder="Enter First Name" value="<?php if(isset($user_details->first_name) && $user_details->first_name){echo $user_details->first_name;}?>">
										</div>
										<div class="form-group">
											<label class="control-label">Last Name <span style="color:#a94442;">*</span></label>
											<input class="form-control" type="text" name="last_name" placeholder="Enter Last Name" value="<?php if(isset($user_details->last_name) && $user_details->last_name){echo $user_details->last_name;}?>">
										</div>
										<div class="form-group">
											<label class="control-label">Password <span style="color:#a94442;">*</span></label>
											<input class="form-control" type="password" name="password" placeholder="Enter Password" value="">
										</div>
										<div class="form-group">
											<label class="control-label">Email Address <span style="color:#a94442;">*</span></label>
											<input class="form-control" type="email" name="email" placeholder="Enter Email" value="<?php if(isset($user_details->email) && $user_details->email){echo $user_details->email;}?>">
										</div>
										<div class="form-group">
											<label class="control-label">Phone <span style="color:#a94442;">*</span></label>
											<input class="form-control" type="text" name="phone" placeholder="Enter Phone" value="<?php if(isset($user_details->phone) && $user_details->phone){echo $user_details->phone;}?>">
										</div>
										<div class="form-group">
											<label class="control-label">Address1 <span style="color:#a94442;">*</span></label>
											<textarea class="form-control" name="address1" placeholder="Enter Address1"><?php if(isset($user_details->address1) && $user_details->address1){echo $user_details->address1;}?></textarea>
										</div>
										<div class="form-group">
											<label class="control-label">Address2</label>
											<textarea class="form-control" name="address2" placeholder="Enter Address2"><?php if(isset($user_details->address2) && $user_details->address2){echo $user_details->address2;}?></textarea>
										</div>
										<div class="form-group">
											<label class="control-label">City <span style="color:#a94442;">*</span></label>
											<input class="form-control" type="text" name="city" placeholder="Enter City" value="<?php if(isset($user_details->city) && $user_details->city){echo $user_details->city;}?>">
										</div>
										<div class="form-group">
											<label class="control-label">Post Code <span style="color:#a94442;">*</span></label>
											<input class="form-control" type="text" name="post_code" placeholder="Enter Post Code" value="<?php if(isset($user_details->post_code) && $user_details->post_code){echo $user_details->post_code;}?>">
										</div>
										<div class="form-group">
											<label class="control-label">Country <span style="color:#a94442;">*</span></label>
											<select id="country_id" name="country_id" class="form-control">
												<option value="">Select Country</option>
												<?php
													if(!empty($country)){
														foreach ($country as $value) {
												?>
												<option value="<?php echo $value->country_id;?>" <?php if(isset($user_details) && ($value->country_id == $user_details->country_id)){echo 'selected';}?>><?php echo $value->name;?></option>
												<?php
														}
													}
												?>
											</select>
										</div>
										<div class="form-group">
											<label class="control-label">State <span style="color:#a94442;">*</span></label>
											<select id="state_id" name="state_id" class="form-control">
												<?php 
													if(!empty($states)){
														foreach ($states as $value) {
												?>
												<option value="<?php echo $value->state_id;?>" <?php if(isset($user_details) && ($value->state_id == $user_details->state_id)){echo 'selected';}?>><?php echo $value->name;?></option>
												<?php
														}
													}
												?>
											</select>
										</div>
										<div class="form-group">
											<label class="control-label">Status</label>
											<label class="radio-inline">
												<input type="radio" name="status" value="Y" <?php if(isset($user_details->status)){if($user_details->status == "Y"){echo 'checked';}}else{echo 'checked';}?>>Active
											</label>
											<label class="radio-inline">
												<input type="radio" name="status" value="N" <?php if(isset($user_details->status)){if($user_details->status == "N"){echo 'checked';}}?>>Inactive
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