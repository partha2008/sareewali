		<?php echo $head; ?>
		
		<div id="wrapper">

			<?php echo $header; ?>

			<div id="page-wrapper" style="min-height: 325px;">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Update Banner</h1>
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
							<?php echo $this->session->userdata('banner_notification');?>
						</div>
						<?php } ?>
						<?php if(isset($sess_notify) & $sess_notify){?>
						<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<?php echo $this->session->userdata('banner_notification');?>
						</div>
						<?php } 
							$this->session->unset_userdata('has_error');
							$this->session->unset_userdata('banner_notification');						
						?>
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-12">
										<form action="<?php echo base_url('admin/banner/edit_banner');?>" method="POST" role="form" enctype="multipart/form-data">
											<div class="form-group">
												<label class="control-label">Title <span style="color:#a94442;">*</span></label>
												<input class="form-control" type="text" name="title" placeholder="Enter Title" value="<?php if(isset($banner_data->title)){echo $banner_data->title;}?>">
											</div>
											<div class="form-group">
												<label class="control-label">Description <span style="color:#a94442;">*</span></label>
												<textarea name="description" class="form-control" placeholder="Enter Description"><?php echo (isset($banner_data->description) && $banner_data->description) ? $banner_data->description : '';?></textarea>
											</div>
											<div class="form-group">
												<label class="control-label">Banner</label>
												<input class="form-control" type="file" name="path">
											</div>
											<div class="form-group">
												<?php
													if(isset($banner_data->path) && file_exists($banner_data->path)){
												?>
												<img src="<?php echo ROOT_URL.$banner_data->path.'?v='.time();?>" width="230">
												<?php
													}
												?>
											</div>
											<div class="form-group">
												<label class="control-label">Sort Order</label>
												<select name="sort_order" class="form-control">
												<?php
													for($i=0;$i<$banner_count;$i++){
												?>
													<option value="<?php echo $i+1;?>" <?php if(($i+1)==$banner_data->sort_order){echo 'selected';}?> ><?php echo $i+1;?></option>
												<?php
													}
												?>
												</select>
											</div>
											<div class="form-group">
												<label class="control-label">Status</label>
												<label class="radio-inline">
													<input type="radio" name="status" value="Y" <?php if(isset($banner_data->status)){if($banner_data->status == 'Y'){echo 'checked';}}else{echo 'checked';}?>>Active
												</label>
												<label class="radio-inline">
													<input type="radio" name="status" value="N" <?php if(isset($banner_data->status)){if($banner_data->status == 'N'){echo 'checked';}}else{echo 'checked';}?>>Inactive
												</label>
											</div>
											<input type="hidden" name="banner_id" value="<?php echo $banner_data->banner_id;?>">
											
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