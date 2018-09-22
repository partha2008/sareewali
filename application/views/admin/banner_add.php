		<?php echo $head; ?>
		
		<div id="wrapper">

			<?php echo $header; ?>

			<div id="page-wrapper" style="min-height: 325px;">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Add Banner</h1>
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
										<form action="<?php echo base_url('admin/banner/add_banner');?>" method="POST" role="form" enctype="multipart/form-data">
											<div class="form-group">
												<label class="control-label">Title <span style="color:#a94442;">*</span></label>
												<input class="form-control" type="text" name="title" placeholder="Enter Title" value="<?php if(isset($banner_data->title)){echo $banner_data->title;}?>">
											</div>
											<div class="form-group">
												<label class="control-label">Description <span style="color:#a94442;">*</span></label>
												<textarea name="description" class="form-control" placeholder="Enter Description"><?php echo (isset($product_details->description) && $product_details->description) ? $product_details->description : '';?></textarea>
											</div>
											<div class="form-group">
												<label class="control-label">Banner</label>
												<input class="form-control" type="file" name="path">
											</div>
											<div class="form-group">
												<?php
													if(isset($banner_data->path) && file_exists(UPLOAD_RELATIVE_BANNER_PATH.$banner_data->path)){
												?>
												<img src="<?php echo UPLOAD_RELATIVE_BANNER_PATH.$banner_data->path.'?v='.time();?>" width="230">
												<?php
													}
												?>
											</div>
											<div class="form-group">
												<label class="control-label">Sort Order</label>
												<select name="sort_order" class="form-control">
												<?php
													for($i=0;$i<count($banner_data)+1;$i++){
												?>
													<option value="<?php echo $i+1;?>"><?php echo $i+1;?></option>
												<?php
													}
												?>
												</select>
											</div>
											<div class="form-group">
												<label class="control-label">Status</label>
												<label class="radio-inline">
													<input type="radio" name="status" value="Y" <?php if(isset($product_details->status)){if($product_details->status){echo 'checked';}}else{echo 'checked';}?>>Active
												</label>
												<label class="radio-inline">
													<input type="radio" name="status" value="N" <?php if(isset($product_details->status)){if(!$product_details->status){echo 'checked';}}else{echo 'checked';}?>>Inactive
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