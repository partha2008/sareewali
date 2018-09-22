<div class="col-md-3">
	<div class="myAccountLeft">
		<ul>
			<li><a href="<?php echo base_url('myaccount');?>" class="<?php echo ($tot_segments[2] == 'myaccount') ? 'myAccountLeftActive' : '';?>">My Account</a></li>
			<li><a href="<?php echo base_url('orderhistory');?>" class="<?php echo ($tot_segments[2] == 'orderhistory') ? 'myAccountLeftActive' : '';?>">Order History</a></li>
			<li><a href="<?php echo base_url('mywishlist');?>" class="<?php echo ($tot_segments[2] == 'mywishlist') ? 'myAccountLeftActive' : '';?>">My Wishlist</a></li>
			<li><a href="<?php echo base_url('changepassword');?>" class="<?php echo ($tot_segments[2] == 'changepassword') ? 'myAccountLeftActive' : '';?>">Change Password</a></li>
			<li><a href="<?php echo base_url('home/logout');?>">Logout</a></li>
		</ul>
	</div>                
</div>