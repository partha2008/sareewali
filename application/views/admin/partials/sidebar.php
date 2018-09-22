	<div class="navbar-default sidebar" role="navigation">
		<div class="sidebar-nav navbar-collapse">
			<ul class="nav" id="side-menu">					
				<li>
					<a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
				</li>
				<li>
					<a href="#"><i class="fa fa-users fa-fw"></i> User Management<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li>
							<a href="<?php echo base_url('admin/user-list');?>"><i class="fa fa-th-list fa-fw"></i> User List</a>
						</li>
						<li>
							<a href="<?php echo base_url('admin/user-add');?>"><i class="fa fa-plus fa-fw"></i> Add User</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#"><i class="fa fa-image fa-fw"></i> Banner Management<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li>
							<a href="<?php echo base_url('admin/banner-list');?>"><i class="fa fa-th-list fa-fw"></i> Banner List</a>
						</li>
						<li>
							<a href="<?php echo base_url('admin/banner-add');?>"><i class="fa fa-plus fa-fw"></i> Add Banner</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="<?php echo base_url('admin/ads');?>"><i class="fa fa-video-camera fa-fw"></i> Ads Management</a>
				</li>
				<li>
					<a href="#"><i class="fa fa-cogs fa-fw"></i> Entity Management<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li>
							<a href="<?php echo base_url('admin/entity-list');?>"><i class="fa fa-th-list fa-fw"></i> Entity List</a>
						</li>
						<li>
							<a href="<?php echo base_url('admin/entity-add');?>"><i class="fa fa-plus fa-fw"></i> Add Entity</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#"><i class="fa fa-retweet fa-fw"></i> Product Management<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li>
							<a href="<?php echo base_url('admin/product-list');?>"><i class="fa fa-th-list fa-fw"></i> Product List</a>
						</li>
						<li>
							<a href="<?php echo base_url('admin/product-add');?>"><i class="fa fa-plus fa-fw"></i> Add Product</a>
						</li>
					</ul>
				</li>
				<!--<li>
					<a href="#"><i class="fa fa-shopping-cart fa-fw"></i> Order Management<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li>
							<a href="<?php echo base_url('admin/order-list');?>" style="color:green;"><i class="fa fa-th-list fa-fw"></i> Order List</a>
						</li>
						<li>
							<a href="<?php echo base_url('admin/failed-order-list');?>" style="color:red;"><i class="fa fa-th-list fa-fw"></i> Failed Order List</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#"><i class="fa fa-lock fa-fw"></i> Coupon Management<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li>
							<a href="<?php echo base_url('admin/coupon-list');?>"><i class="fa fa-th-list fa-fw"></i> Coupon List</a>
						</li>
						<li>
							<a href="<?php echo base_url('admin/coupon-add');?>"><i class="fa fa-plus fa-fw"></i> Add Coupon</a>
						</li>
					</ul>
				</li>-->
				<li>
					<a href="#"><i class="fa fa-envelope fa-fw"></i> Newsletter Management<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li>
							<a href="<?php echo base_url('admin/newsletter');?>"><i class="fa fa-th-list fa-fw"></i> Newsletter</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#"><i class="fa fa-th fa-fw"></i> Content Management<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li>
							<a href="<?php echo base_url('admin/term');?>"><i class="fa fa-hand-o-right fa-fw"></i> Terms & Conditions</a>
							<a href="<?php echo base_url('admin/privacy');?>"><i class="fa fa-hand-o-right fa-fw"></i> Privacy & Policy</a>
							<a href="<?php echo base_url('admin/return');?>"><i class="fa fa-hand-o-right fa-fw"></i> Cancellation & Returns</a>
							<a href="<?php echo base_url('admin/shipping');?>"><i class="fa fa-hand-o-right fa-fw"></i> Shipping Policy</a>
							<a href="<?php echo base_url('admin/about');?>"><i class="fa fa-hand-o-right fa-fw"></i> About Us</a>
							<a href="<?php echo base_url('admin/feedback');?>"><i class="fa fa-hand-o-right fa-fw"></i> Feedback</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
		<!-- /.sidebar-collapse -->
	</div>
	<!-- /.navbar-static-side -->