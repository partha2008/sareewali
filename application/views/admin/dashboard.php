		<?php echo $head; ?> 
		
		<div id="wrapper">

			<?php echo $header; ?> 

			<div id="page-wrapper">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Dashboard</h1>
					</div>
					<!-- /.col-lg-12 -->
				</div>
				<!-- /.row -->
				
				<div class="row">
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-gear fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">Settings</div>
									</div>
								</div>
							</div>
							<a href="<?php echo base_url('admin/settings');?>">
								<div class="panel-footer">
									<span class="pull-left">View Details</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-green">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-user fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">Profile</div>
									</div>
								</div>
							</div>
							<a href="<?php echo base_url('admin/profile');?>">
								<div class="panel-footer">
									<span class="pull-left">View Details</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-ash">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-users fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">User</div>
									</div>
								</div>
							</div>
							<a href="<?php echo base_url('admin/user-list');?>">
								<div class="panel-footer">
									<span class="pull-left">View Details</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-yellow">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-image fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">Banner</div>
									</div>
								</div>
							</div>
							<a href="<?php echo base_url('admin/banner-list');?>">
								<div class="panel-footer">
									<span class="pull-left">View Details</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>					
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-red">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-cogs fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">Entity</div>
									</div>
								</div>
							</div>
							<a href="<?php echo base_url('admin/entity-list');?>">
								<div class="panel-footer">
									<span class="pull-left">View Details</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-sky">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-retweet fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">Product</div>
									</div>
								</div>
							</div>
							<a href="<?php echo base_url('admin/product-list');?>">
								<div class="panel-footer">
									<span class="pull-left">View Details</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-yellowish">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-envelope fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="small">Newsletter</div>
									</div>
								</div>
							</div>
							<a href="<?php echo base_url('admin/newsletter');?>">
								<div class="panel-footer">
									<span class="pull-left">View Details</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-pinkish">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-video-camera fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="small">Ads</div>
									</div>
								</div>
							</div>
							<a href="<?php echo base_url('admin/ads');?>">
								<div class="panel-footer">
									<span class="pull-left">View Details</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-wood">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-shopping-cart fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">Order</div>
									</div>
								</div>
							</div>
							<a href="<?php echo base_url('admin/order-list');?>">
								<div class="panel-footer">
									<span class="pull-left">View Details</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-woods">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-lock fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">Coupon</div>
									</div>
								</div>
							</div>
							<a href="<?php echo base_url('admin/coupon-list');?>">
								<div class="panel-footer">
									<span class="pull-left">View Details</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					
				</div>
				<!-- /.row -->
				
			</div>
			<!-- /#page-wrapper -->

		</div>
		<!-- /#wrapper -->
		
		<?php echo $footer; ?> 
