		<?php echo $head; ?>
		
		<div id="wrapper">

			<?php echo $header; ?>

			<div id="page-wrapper" style="min-height: 325px;">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Admin Settings</h1>
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
							<?php echo $this->session->userdata('settings_notification');?>
						</div>
						<?php } ?>
						<?php if(isset($sess_notify) & $sess_notify){?>
						<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<?php echo $this->session->userdata('settings_notification');?>
						</div>
						<?php } 
							$this->session->unset_userdata('has_error');
							$this->session->unset_userdata('settings_notification');						
						?>
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-12">
										<form action="<?php echo base_url('admin/user/process_settings');?>" method="POST" role="form" enctype="multipart/form-data">
											<div class="form-group">
												<label class="control-label">Site Name <span style="color:#a94442;">*</span></label>
												<input class="form-control" type="text" name="sitename" placeholder="Enter Sitename" value="<?php if(isset($settings_data->sitename)){echo $settings_data->sitename;}?>">
											</div>
											<div class="form-group">
												<label class="control-label">Site Address <span style="color:#a94442;">*</span></label>
												<input class="form-control" type="text" name="siteaddress" placeholder="Enter Site Address" value="<?php if(isset($settings_data->siteaddress)){echo $settings_data->siteaddress;}?>">
											</div>
											<div class="form-group">
												<label class="control-label">Site Logo</label>
												<input class="form-control" type="file" name="logo">
											</div>
											<div class="form-group">
												<?php
													if(isset($settings_data->logoname) && file_exists(UPLOAD_LOGO_PATH.$settings_data->logoname)){
												?>
												<img src="<?php echo UPLOAD_LOGO_PATH.$settings_data->logoname.'?v='.time();?>" width="230">
												<?php
													}
												?>
											</div>
											<div class="form-group">
												<label class="control-label">Facebook Page URL <span style="color:#a94442;">*</span></label>
												<input class="form-control" type="text" name="facebook_page_url" placeholder="Enter Site Address" value="<?php if(isset($settings_data->facebook_page_url)){echo $settings_data->facebook_page_url;}?>">
											</div>
											<div class="form-group">
												<label class="control-label">GST Reg No <span style="color:#a94442;">*</span></label>
												<input class="form-control" type="text" name="gst_no" placeholder="Enter GST Reg No" value="<?php if(isset($settings_data->gst_no)){echo $settings_data->gst_no;}?>">
											</div>
											<input type="hidden" name="settings_id" value="<?php if(isset($settings_data->settings_id)){echo $settings_data->settings_id;}?>">
											<input type="hidden" name="logopathname" value="<?php if(isset($settings_data->logopathname)){echo $settings_data->logopathname;}?>">
											<input type="hidden" name="logoname" value="<?php if(isset($settings_data->logoname)){echo $settings_data->logoname;}?>">
											
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