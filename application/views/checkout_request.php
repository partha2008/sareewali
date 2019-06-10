<html>
	<head>
		<title><?php echo $general_settings->sitename;?></title>
		<link rel="shortcut icon" href="<?php echo base_url(); ?>/favicon.ico" type="image/x-icon">
		<link rel="icon" href="<?php echo base_url(); ?>/favicon.ico" type="image/x-icon">
	<style>
		body {
		  background: #eaecfa;
		}
		.loader {
		  width: 400px;
		  height: 50px;
		  line-height: 50px;
		  text-align: center;
		  position: absolute;
		  top: 50%;
		  left: 50%;
		  transform: translate(-50%, -50%);
		  font-family: helvetica, arial, sans-serif;
		  text-transform: uppercase;
		  font-weight: 900;
		  color: #ce4233;
		  letter-spacing: 0.2em;
		}
		.loader::before, .loader::after {
		  content: "";
		  display: block;
		  width: 15px;
		  height: 15px;
		  background: #ce4233;
		  position: absolute;
		  animation: load 0.9s infinite alternate ease-in-out;
		}
		.loader::before {
		  top: 0;
		}
		.loader::after {
		  bottom: 0;
		}
		@keyframes load {
		  0% {
		    left: 0;
		    height: 30px;
		    width: 15px;
		  }
		  50% {
		    height: 8px;
		    width: 40px;
		  }
		  100% {
		    left: 380px;
		    height: 30px;
		    width: 15px;
		  }
		}
	</style>
	</head>
	<body>
		<div class="loader">You are being redirected...</div>
		<center>
			<?php 	
				$session = $this->session->userdata('checkout');
				$merchant_data = $this->config->item('site_info')['ccavenue_merchant_id'];
				$working_key = $this->config->item('site_info')['ccavenue_working_key'];
				$access_code = $this->config->item('site_info')['ccavenue_access_code'];
				
				foreach ($session as $key => $value){
					$merchant_data.=$key.'='.urlencode($value).'&';
				}
				$this->session->unset_userdata('checkout');

				$encrypted_data = $this->defaultdata->encrypt($merchant_data,$working_key); 
			?>
			<form method="post" name="redirect" action="<?php echo $this->config->item('site_info')['ccavenue_test_url']; ?>"> 
			<?php
				echo "<input type=hidden name=encRequest value=$encrypted_data>";
				echo "<input type=hidden name=access_code value=$access_code>";
			?>
			</form>
		</center>
		<script language='javascript'>document.redirect.submit();</script>
	</body>
</html>

