		<?php echo $head; ?>
		
		<div id="wrapper">
			<?php echo $header; ?>

			<div id="page-wrapper" style="min-height: 325px;">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Admin Profile</h1>
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
							<?php echo $this->session->userdata('profile_notification');?>
						</div>
						<?php } ?>
						<?php if(isset($sess_notify) & $sess_notify){?>
						<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<?php echo $this->session->userdata('profile_notification');?>
						</div>
						<?php } 
							$this->session->unset_userdata('has_error');
							$this->session->unset_userdata('profile_notification');						
						?>
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-12">
										<form action="<?php echo base_url('admin/user/process_profile');?>" method="POST" role="form" novalidate>
											<div class="form-group">
												<label class="control-label">Username <span style="color:#a94442;">*</span></label>
												<input class="form-control" type="text" name="username" placeholder="Enter Username" value="<?php echo $profile_data->username;?>">
											</div>
											<div class="form-group">
												<label class="control-label">Password</label>
												<input class="form-control" type="password" name="password" placeholder="Enter Password" value="">
											</div>
											<div class="form-group">
												<label class="control-label">Email Address <span style="color:#a94442;">*</span></label>
												<input class="form-control" type="email" name="email" placeholder="Enter Email" value="<?php echo $profile_data->email;?>">
											</div>
											<div class="form-group">
												<label class="control-label">Contact No <span style="color:#a94442;">*</span></label>
												<input class="form-control" type="text" name="contact_no" placeholder="Contact No" value="<?php echo $profile_data->contact_no;?>">
											</div>
											<div class="form-group">
												<label class="control-label">Address <span style="color:#a94442;">*</span></label>
												<textarea id="term" name="address"><?php echo $profile_data->address;?></textarea>
											</div>
											<div class="form-group">
												<label class="control-label">Status</label>
												<label class="radio-inline">
													<input type="radio" name="is_active" value="1" <?php if($profile_data->is_active == 1){echo 'checked';}?>>Active
												</label>
												<label class="radio-inline">
													<input type="radio" name="is_active" value="0" <?php if($profile_data->is_active == 0){echo 'checked';}?>>Inactive
												</label>
											</div>
											
											<input type="hidden" name="original_password" value="<?php echo $profile_data->original_password;?>">
											<input type="hidden" name="old_username" value="<?php echo $profile_data->username;?>">
											<input type="hidden" name="old_email" value="<?php echo $profile_data->email;?>">
											
											<button type="submit" class="btn btn-primary" id="update_profle_btn">Save Changes</button>
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