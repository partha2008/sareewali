<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
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
						<h3 class="panel-title">Please Sign In</h3>
					</div>
					<div class="panel-body">
						<?php if($this->session->userdata('login_error') == 'true'){?>
							<div class='alert alert-danger alert-dismissable'>
								<?php
									echo $this->session->userdata('login_error_msg');
								?>
							</div>
						<?php 
							}  
							$this->session->unset_userdata('login_error');
							$this->session->unset_userdata('login_error_msg'); 
						?>
						<form action="<?php echo base_url('admin/user/process_login');?>" method="POST" role="form">
							<fieldset>
								<div class="form-group">
									<input class="form-control" placeholder="Username" name="username" type="text" autofocus>
								</div>
								<div class="form-group">
									<input class="form-control" placeholder="Password" name="password" type="password" value="">
								</div>
								<div class="checkbox">
									<label>
										<input name="remember" type="checkbox" value="Remember Me">Remember Me
									</label>
								</div>
								<button class="btn btn-lg btn-success btn-block" type="submit">Login</button>
								<div class="checkbox">
									<a class="help-block" href="<?php echo base_url('admin/forget-password');?>">Forgot Password?</a>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php echo $footer;?>	