	<?php echo $head;?>
	
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4 text-center" style="margin-top:5%;">
				<?php
					if(isset($general_settings->logoname) && file_exists(UPLOAD_RELATIVE_LOGO_PATH.$general_settings->logoname)){
				?>
					<img src="<?php echo UPLOAD_LOGO_PATH.$general_settings->logoname.'?v='.time();?>">
				<?php
					}
				?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-panel panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Password Recovery</h3>
					</div>
					<div class="panel-body">
						<?php 
							$sess_notify = $this->session->userdata('has_error');
							if(isset($sess_notify) & $sess_notify){
						?>
							<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<?php echo $this->session->userdata('forget_notification');?>
							</div>
						<?php } 
						if(isset($sess_notify) & !$sess_notify){?>
							<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<?php echo $this->session->userdata('forget_notification');?>
							</div>
						<?php } 
							$this->session->unset_userdata('has_error');
							$this->session->unset_userdata('forget_notification');
						?>
						<form action="<?php echo base_url('admin/user/process_forget');?>" method="POST" role="form" novalidate>
							<fieldset>
								<div class="form-group">
									<input class="form-control" placeholder="Enter Email Address" name="email" type="email" value="<?php if(isset($forget_details->email) && $forget_details->email){echo $forget_details->email;}?>" autofocus>
								</div>
								<button class="btn btn-lg btn-success btn-block" type="submit">Reset Your Password</button>
								<div class="checkbox">
									<a class="help-block" href="<?php echo base_url('admin');?>"><i class="fa fa-arrow-circle-left"></i> Login</a>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php echo $footer; ?>

