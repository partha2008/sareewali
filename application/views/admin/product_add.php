	<?php echo $head;?>
	
	<div id="wrapper">

		<?php echo $header;?>

		<div id="page-wrapper" style="min-height: 325px;">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Add Product</h1>
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
							<?php echo $this->session->userdata('productadd_notification');?>
						</div>
					<?php } 
						$this->session->unset_userdata('has_error');
						$this->session->unset_userdata('productadd_notification');
					?>
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
									<form action="<?php echo base_url('admin/product/add_product');?>" method="POST" role="form" enctype="multipart/form-data">
										<div class="form-group">
											<label class="control-label">Entity <span style="color:#a94442;">*</span></label>
											<select name="entity_id[]" class="form-control" multiple="multiple">
												<?php if(count($cat_list) > 0){ ?>
													<?php foreach($cat_list AS $list) {?>
														<option value="<?php echo $list->entity_id;?>"
															<?php
																if(isset($product_details)){
																	if(in_array($list->entity_id, $product_details->entity_id)){
																		echo 'selected';
																	}
																}
															?>
														>	
														<?php echo $list->name;?>
														</option>
													<?php } ?>
												<?php } ?>
											</select>
										</div>
										<div class="form-group">
											<label class="control-label">Name <span style="color:#a94442;">*</span></label>
											<input class="form-control" type="text" name="name" placeholder="Enter Product Name" value="<?php echo (isset($product_details->name) && $product_details->name) ? $product_details->name : '';?>">
										</div>
										<div class="form-group">
											<label class="control-label">Description <span style="color:#a94442;">*</span></label>
											<textarea id="term" name="description" class="form-control" placeholder="Enter Description"><?php echo (isset($product_details->description) && $product_details->description) ? $product_details->description : '';?></textarea>
										</div>									
										<div class="form-group">
											<label class="control-label">Label Price <span style="color:#a94442;">*</span></label>
											<input class="form-control" type="text" name="price" value="<?php echo (isset($product_details->price) && $product_details->price) ? $product_details->price : '';?>">
										</div>
										<div class="form-group">
											<label class="control-label">Quantity <span style="color:#a94442;">*</span></label>
											<input class="form-control" type="number" name="quantity" min="1" value="<?php echo (isset($product_details->quantity) && $product_details->quantity) ? $product_details->quantity : '';?>">
										</div>
										<div class="form-group">
											<label class="control-label">SKU <span style="color:#a94442;">*</span></label>
											<input class="form-control" type="text" name="sku" value="<?php echo (isset($product_details->sku) && $product_details->sku) ? $product_details->sku : '';?>">
										</div>
										<div class="form-group">
											<label class="control-label">Color <span style="color:#a94442;">*</span></label>
											<select class="form-control js-example-tags" multiple="multiple" name="color[]">
											  	<option selected="selected">orange</option>
											  	<option>white</option>
											  	<option selected="selected">purple</option>
											</select>
										</div>
										<div class="form-group">
											<label class="control-label">Out of Stock</label>
											<label class="radio-inline">
												<input type="radio" name="out_of_stock" value="Y" <?php if(isset($product_details->out_of_stock)){if($product_details->out_of_stock == 'Y'){echo 'checked';}}else{echo 'checked';}?> >Yes
											</label>
											<label class="radio-inline">
												<input type="radio" name="out_of_stock" value="N" <?php if(isset($product_details->out_of_stock)){if($product_details->out_of_stock == 'N'){echo 'checked';}}else{echo 'checked';}?> >No
											</label>
										</div>
										<div class="form-group">
											<label class="control-label">Attribute <span style="color:#a94442;">*</span></label>
											<div class="row">
												<div class="col-lg-12">
													<button id="add_attr_btn" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</button>
												</div>
											</div>

											<div class="panel-body">
												<span id="attrelm">
													<div class="row mb-10">
														<div class="col-lg-3">
															<input type="text" class="form-control" name="attrname[]" placeholder="Name" required>
														</div>
														<div class="col-lg-3">
															<input type="text" class="form-control" name="attrval[]" placeholder="Value" required>
														</div>
														<div class="col-lg-3">
															<select name="attrunit[]" class="form-control">
																<?php
																	if(!empty($unit)){
																		echo '<option value="">None</option>';
																		foreach ($unit as $key => $value) {
																?>
																			<option value="<?php echo $key;?>"><?php echo $value;?></option>
																<?php
																		}
																	}
																?>
															</select>
														</div>
														<div class="col-lg-3">
															<button type="button" class="btn btn-danger btn-circle">
																<i class="fa fa-times"></i> 
															</button> 
														</div>
													</div>
												</span>
												<span id="container"></span>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label">Upload Images <span style="color:#a94442;">*</span></label>	
											<?php
												$this->load->view('admin/partials/upload');
											?>										    
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
										<input type="hidden" id="upload_image" name="upload_image" value="">
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