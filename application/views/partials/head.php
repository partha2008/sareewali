<!DOCTYPE HTML>

<html>

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<title><?php echo $general_settings->sitename;?></title>

<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">

<link rel="icon" href="./favicon.ico" type="image/x-icon">

<link href="<?php echo base_url(); ?>resources/css/font-awesome.min.css" rel="stylesheet">

<link rel="stylesheet" href="<?php echo base_url(); ?>resources/css/bootstrap.min.css" />

<link rel="stylesheet" href="<?php echo base_url(); ?>resources/css/owl.theme.css" />

<link rel="stylesheet" href="<?php echo base_url(); ?>resources/css/owl.carousel.css" />

<?php
	if($tot_segments[1] == 'product-details'){
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>resources/css/stylesheet.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>resources/css/zoom.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>resources/css/magiczoomplus.css" />
<?php
}elseif($tot_segments[1] == 'product-list'){
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>resources/css/CustomScrollbar.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>resources/css/jquery-ui.css" />
<?php
}else{
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>resources/css/animate.css" />
<?php
}
?>

<link href="<?php echo base_url(); ?>resources/css/global.css" rel="stylesheet" type="text/css">

<link href="<?php echo base_url(); ?>resources/css/responsive.css" rel="stylesheet" type="text/css">
<script>
	var BASEPATH = '<?php echo base_url();?>';
	var PAGENAME = '<?php echo $tot_segments[1];?>';
	var VIEW = '<?php echo isset($tot_segments[3]) ? $tot_segments[3] : $tot_segments[2];?>';
</script>
<?php
    if($tot_segments[1] == 'product-details'){
?>
<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5b9ea1beb698a100116eb785&product=inline-share-buttons' async='async'></script>
<?php
    }
?>
</head>



<body class="<?php ($tot_segments[2] == 'index') ? '' : 'homePage';?>">
<script>
  	window.fbAsyncInit = function() {
	    FB.init({
			appId      : '278943622936517',
			cookie     : true,
			xfbml      : true,
			version    : 'v3.1'
	    });
	      
	    FB.AppEvents.logPageView();   
      
  	};

 	(function(d, s, id){
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) {return;}
		js = d.createElement(s); js.id = id;
		js.src = "https://connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
   	}(document, 'script', 'facebook-jssdk'));

	function checkLoginState() {
		FB.getLoginStatus(function(response) {
			if (response.status === 'connected') {
		      	FB.api('/me?fields=email,first_name,last_name', function(response) {
			      	saveUserInfo(response);
			    });
		    }
		});
	}
</script>