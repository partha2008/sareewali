<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $site_name;?></title>
<style>
    @import url(http://fonts.googleapis.com/css?family=Merienda);
   /* All your usual CSS here */
</style>
</head>

<body style="width:100%; padding:0px; margin:0px;  font-family:Helvetica, Arial, Verdana, Trebuchet MS; ">
<div style=" width:745px; max-width:98%; padding:0px; margin:0 auto; background:#ffffff; height:auto; -webkit-box-shadow: 0px 5px 16px 0px rgba(0, 0, 0, 0.11);
-moz-box-shadow:0px 5px 16px 0px rgba(0, 0, 0, 0.11); box-shadow:0px 5px 16px 0px rgba(0, 0, 0, 0.11);">
<div style=" width:100%; margin:0px; padding:0px; text-align:center; clear:both;"><img src="<?php echo $site_logo;?>" alt="logo" style="max-width:100%; height:auto;" /></div>


<div style=" display:block; max-width:80%; clear:both; padding:15px 0px 0px 0px; margin:0px auto;">
<h1 style="width:100%; padding:0px 0px 30px 0px; margin:0px; color:#e4097f; font-size:22px; font-weight:bold; clear:both;"><?php echo $user_data->first_name;?>, please find your invoice for order #<?php echo $order_data->orderid;?></h1>
<div style="clear:both"></div>
<div style=" width:100%; display:block;max-width:80%; clear:both; padding:55px 0px 32px 0px; margin:0 auto; background:url(<?php echo $boder;?>) no-repeat top center;">
<div style="clear:both"></div>
</div>
<div style="clear:both"></div>
<div style="width:100%; padding:0px 0px 30px 0px; margin:0; border:none; outline:none; text-align:center; max-width:100%">
  <img src="<?php echo $email_banner;?>" alt="banner" style="max-width:100%; height:auto;" /></div>
  
<div style="clear:both"></div>
<div style=" width:100%; display:block; clear:both; padding:0px 0px 32px 0px; margin:0 auto;">
<h1 style="width:100%; padding:0px 0px 20px 0px; margin:0px; color:#e4097f; font-size:30px; font-weight:bold; clear:both; text-align:center; text-transform:uppercase; font-weight:bold;">
FOLLOW US</h1>
<div style="width:100%; max-width:100%; display:block; padding:0px 0px 0px 0px; margin:0px; clear:both;">
<a href="<?php echo $fb_link;?>" style=" width:48%; background-size:contain; height:93px; background: url(<?php echo $fb_img;?>) no-repeat left top #3b5998; float:left; text-decoration:none;"><span style=" display:block; padding:22px 0px 0px 154px; padding-left:40%; 
margin:0px;  font-size:22px; color:#ffffff; text-align:left; font-weight:bold;">Like <br /><?php echo $site_name;?></span></a>

<a href="<?php echo $tw_link;?>" style=" width:48%; background-size:contain; height:93px; background: url(<?php echo $tw_img;?>) no-repeat left top #00aced; float:right; text-decoration:none;"><span style=" display:block; padding:22px 0px 0px 154px; padding-left:40%; 
margin:0px;  font-size:22px; color:#ffffff; text-align:left; font-weight:bold;">Like <br /><?php echo $site_name;?></span></a>
<div style="clear:both"></div>
</div>
</div>

<div style="clear:both"></div>
</div>
<div style="clear:both"></div>
<div style=" width:745px; max-width:98%; padding:30px 0px 40px 0px; margin:0 auto; font-size:12px; line-height:14px; color:#b5b4b4; text-align:center;" >
You received this email because you are registered on <?php echo $site_name;?> with the email<br />
<h3 style="width:100%; font-size:16px; font-weight:bold;">CONTACT US</h3> 
<?php echo $admin_profile->address;?>
&copy; 2018, <?php echo $site_title;?>
</div>
</body>
</html>
