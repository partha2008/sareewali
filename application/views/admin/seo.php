		<?php echo $head; ?>
		
		<div id="wrapper">

			<?php echo $header; ?>

			<div id="page-wrapper" style="min-height: 325px;">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Update SEO Details</h1>
					</div>
					<!-- /.col-lg-12 -->
				</div>
				<!-- /.row -->
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-12">
										<form action="<?php echo base_url('admin/seo/update_seo');?>" method="POST" role="form">
											<div class="form-group">
												<label class="control-label">Page</label>
												<select name="page_value" class="form-control" onchange="redirectURI(this.value)">
													<option value="">Select Page</option>
													<?php 
														if(!empty($pages)){
															foreach ($pages as $key => $value) {
													?>
														<option value="<?php echo $value->page_value;?>" <?php if($value->page_value == $this->input->get('page')){echo 'selected';}?>><?php echo $value->page_name;?></option>
													<?php
															}
														}
													?>
												</select>
											</div>
											<?php
												if($this->input->get('page')){
											?>
												<div class="form-group">
													<label class="control-label">Title</label>
													<input class="form-control" type="text" name="title" placeholder="Enter Title" value="<?php echo $seo_data->title;?>">
												</div>
												<div class="form-group">
													<label class="control-label">Meta Description</label>
													<textarea class="form-control" name="meta_desc" placeholder="Enter Description"><?php echo $seo_data->meta_desc;?></textarea>
											
												</div>	
												<div class="form-group">
													<label class="control-label">Meta Keywords</label>
													<textarea class="form-control" name="meta_key" placeholder="Enter Keywords"><?php echo $seo_data->meta_key;?></textarea>
												</div>	
											<?php
												}
											?>											
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

		<script type="text/javascript">
			function redirectURI(val){
				if(val){
					window.location.href = BASEPATH+'admin/seo?page='+val;
				}				
			}
		</script>