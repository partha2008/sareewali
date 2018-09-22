	<?php echo $head;?>
	
	<div id="wrapper">

		<?php echo $header;?>

		<div id="page-wrapper" style="min-height: 325px;">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"><?php echo $title;?></h1>
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
						<?php echo $this->session->userdata('cms_notification'); ?>
					</div>
					<?php } 						
						if(isset($sess_notify) & !$sess_notify){
					?>
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						Terms changes have been saved successfully.
					</div>
					<?php
						}
						$this->session->unset_userdata('has_error');
						$this->session->unset_userdata('cms_notification');
					?>
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
									<form action="<?php echo base_url('admin/user/update_cms');?>" method="POST" role="form" novalidate>
										<div class="form-group">
											<label class="control-label">Title <span style="color:#a94442;">*</span></label>
											<input class="form-control" type="text" name="title" placeholder="Enter Title" value="<?php echo $cms_data->title;?>">
										</div>
										<div class="form-group">
											<label class="control-label">Description <span style="color:#a94442;">*</span></label>
											<textarea id="term" name="description"><?php echo $cms_data->description;?></textarea>
										</div>
										<input type="hidden" name="mode" value="<?php echo $cms_data->mode;?>">
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