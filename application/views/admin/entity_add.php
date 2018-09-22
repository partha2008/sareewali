	<?php echo $head;?>
	
	<div id="wrapper">

		<?php echo $header;?>

		<div id="page-wrapper" style="min-height: 325px;">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Add Entity</h1>
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
							<?php echo $this->session->userdata('catadd_notification');?>
						</div>
					<?php } 
					$this->session->unset_userdata('has_error');
					$this->session->unset_userdata('catadd_notification');
					?>					
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
									<form action="<?php echo base_url('admin/entity/add_entity');?>" method="POST" role="form" enctype="multipart/form-data" novalidate>
										<div class="form-group">
											<label class="control-label">Entity Name <span style="color:#a94442;">*</span></label>
											<input class="form-control" type="text" name="name" placeholder="Enter Entity Name" value="<?php if(isset($cat_details->name) && $cat_details->name){echo $cat_details->name;}?>">
										</div>
										<div class="form-group">
											<label class="control-label">Short Description</label>
											<input class="form-control" type="text" name="description" placeholder="Enter Short Description" value="<?php if(isset($cat_details->description) && $cat_details->description){echo $cat_details->description;}?>">
										</div>
										<div class="form-group">
											<label class="control-label">Image</label>
											<input class="form-control" type="file" name="image_path">
											<p class="text-danger">*Minimum size of the image must be 560 x 472(px)</p>
										</div>
										<div class="form-group">
											<label class="control-label">Parent <span style="color:#a94442;">*</span></label>
											<select name="entity_id" class="form-control">
												<option value="">Select Parent</option>
												<?php if(count($entity_data) > 0){ ?>
													<?php foreach($entity_data AS $list) {?>
														<option value="<?php echo $list->entity_id.'||'.$list->level;?>"><?php echo $list->name;?></option>
													<?php } ?>
												<?php } ?>
											</select>
											<p class="text-danger">*Adding Entity by selecting parent will go under the selected parent. Selecting Root as parent will make the entity as main.</p>[<a id="view_relation" href="javscript:void(0);">View Relation</a>]
										</div>
										<div class="form-group">
											<label class="control-label">Sort Order</label>
											<input class="form-control" type="text" name="sort_order" placeholder="Enter Sort Order" value="<?php if(isset($cat_details->sort_order) && $cat_details->sort_order){echo $cat_details->sort_order;}?>">
										</div>
										<div class="form-group">
											<label class="control-label">Special</label>
											<label class="radio-inline">
												<input type="radio" name="is_special" value="Y" <?php if(isset($cat_details->is_special)){if($cat_details->is_special == 'Y'){echo 'checked';}}?>>Yes
											</label>
											<label class="radio-inline">
												<input type="radio" name="is_special" value="N" <?php if(isset($cat_details->is_special)){if($cat_details->is_special == 'N'){echo 'checked';}}else{echo 'checked';}?>>No
											</label>
										</div>
										<div class="form-group">
											<label class="control-label">Status</label>
											<label class="radio-inline">
												<input type="radio" name="status" value="Y" <?php if(isset($cat_details->status)){if($cat_details->status == 'Y'){echo 'checked';}}else{echo 'checked';}?>>Active
											</label>
											<label class="radio-inline">
												<input type="radio" name="status" value="N" <?php if(isset($cat_details->status)){if($cat_details->status == 'N'){echo 'checked';}}?>>Inactive
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