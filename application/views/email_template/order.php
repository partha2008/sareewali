<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $site_name;?></title>
<style>
    @import url(http://fonts.googleapis.com/css?family=Merienda);
    @import url(https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css);
   /* All your usual CSS here */
</style>
</head>

<body style="width:100%; padding:0px; margin:0px;  font-family:Helvetica, Arial, Verdana, Trebuchet MS; ">
<div style=" width:745px; max-width:98%; padding:0px; margin:0 auto; background:#ffffff; height:auto; -webkit-box-shadow: 0px 5px 16px 0px rgba(0, 0, 0, 0.11);
-moz-box-shadow:0px 5px 16px 0px rgba(0, 0, 0, 0.11); box-shadow:0px 5px 16px 0px rgba(0, 0, 0, 0.11);">
<div style=" width:100%; margin:0px; padding:0px; text-align:center; clear:both;"><img src="<?php echo $site_logo;?>" alt="logo" style="max-width:100%; height:auto;" /></div>


<div style=" display:block; max-width:80%; clear:both; padding:15px 0px 0px 0px; margin:0px auto;">
  <h1 style="width:100%; padding:0px 0px 30px 0px; margin:0px; color:#e4097f; font-size:30px; font-weight:bold; clear:both;">Thanks for order!</h1>

  <h2  style="width:100%; padding:0px 0px 20px 0px; margin:0px; color:#615e5e; font-size:20px; font-weight:normal; clear:both;"><?php echo $name;?>, please find details of your order below:</h2>
  <div style="clear:both"></div>

  <table class="purchase" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; margin: 0; padding: 35px 0; width: 100%;">
                        <tr>
                          <td colspan="2" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; word-break: break-word;">
                            <table class="purchase_content" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; margin: 0; padding: 25px 0 0; width: 100%;">
                              <tr>
                                <th class="purchase_heading" style="border-bottom-color: #EDEFF2; border-bottom-style: solid; border-bottom-width: 1px; box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; padding-bottom: 8px;">
                                  <p style="box-sizing: border-box; color: #9BA2AB; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin: 0;" align="left">Name</p>
                                </th>
                                <th class="purchase_heading" style="border-bottom-color: #EDEFF2; border-bottom-style: solid; border-bottom-width: 1px; box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; padding-bottom: 8px;">
                                  <p style="box-sizing: border-box; color: #9BA2AB; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin: 0;" align="left">SKU</p>
                                </th>
                                <th class="purchase_heading" style="border-bottom-color: #EDEFF2; border-bottom-style: solid; border-bottom-width: 1px; box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; padding-bottom: 8px;">
                                  <p style="box-sizing: border-box; color: #9BA2AB; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin: 0;" align="left">Price</p>
                                </th>
                                <th class="purchase_heading" style="border-bottom-color: #EDEFF2; border-bottom-style: solid; border-bottom-width: 1px; box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; padding-bottom: 8px;">
                                  <p class="align-right" style="box-sizing: border-box; color: #9BA2AB; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin: 0;" align="right">Quantity</p>
                                </th>
                                <th class="purchase_heading" style="border-bottom-color: #EDEFF2; border-bottom-style: solid; border-bottom-width: 1px; box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; padding-bottom: 8px;">
                                  <p class="align-right" style="box-sizing: border-box; color: #9BA2AB; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin: 0;" align="right">Total</p>
                                </th>
                              </tr>
                              <?php
                                foreach ($cart_data as $key => $value) {
                                  if((int)$value->prd_discounted_price > 0){
                                      $unit_price = number_format($value->prd_discounted_price, 2);
                                      $total_price = number_format($value->prd_discounted_price*$value->prd_count, 2);
                                  }else{
                                      $unit_price = number_format($value->prd_price, 2);
                                      $total_price = number_format($value->prd_price*$value->prd_count, 2);
                                  }
                              ?>
                              <tr>
                                <td width="20%" class="purchase_item" style="box-sizing: border-box; color: #74787E; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 15px; line-height: 18px; padding: 10px 0; word-break: break-word;"><?php echo $value->prd_name;?></td>
                                <td width="20%" class="purchase_item" style="box-sizing: border-box; color: #74787E; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 15px; line-height: 18px; padding: 10px 0; word-break: break-word;"><?php echo $value->prd_slug;?></td>
                                <td width="20%" class="purchase_item" style="box-sizing: border-box; color: #74787E; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 15px; line-height: 18px; padding: 10px 0; word-break: break-word;"><i class="fa fa-inr"></i> <?php echo $unit_price;?></td>
                                <td class="align-right" width="20%" style="box-sizing: border-box; color: #74787E; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 15px; line-height: 18px; padding: 10px 0; word-break: break-word;" align="right"><?php echo $value->prd_count;?></td>
                                <td class="align-right" width="20%" style="box-sizing: border-box; color: #74787E; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 15px; line-height: 18px; padding: 10px 0; word-break: break-word;" align="right"><i class="fa fa-inr"></i> <?php echo $total_price;?></td>
                              </tr>
                              <?php
                                }
                              ?>
                              <tr>
                                <td colspan="4" class="align-right" width="20%" style="box-sizing: border-box; color: #000000; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 15px; line-height: 18px; padding: 10px 0; word-break: break-word;font-weight: bold;" align="right">Sub Total</td>
                                <td class="align-right" width="20%" style="box-sizing: border-box; color: #000000; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 15px; line-height: 18px; padding: 10px 0; word-break: break-word;" align="right"><i class="fa fa-inr"></i> <?php echo $response->sub_total;?></td>
                              </tr>
                              <tr>
                                <td colspan="4" class="align-right" width="20%" style="box-sizing: border-box; color: #000000; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 15px; line-height: 18px; padding: 10px 0; word-break: break-word;font-weight: bold;" align="right">Discount</td>
                                <td class="align-right" width="20%" style="box-sizing: border-box; color: #000000; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 15px; line-height: 18px; padding: 10px 0; word-break: break-word;" align="right"><i class="fa fa-inr"></i> <?php echo $response->discount;?></td>
                              </tr>
                              <tr>
                                <td colspan="4" class="align-right" width="20%" style="box-sizing: border-box; color: #000000; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 15px; line-height: 18px; padding: 10px 0; word-break: break-word;font-weight: bold;" align="right">Grand Total</td>
                                <td class="align-right" width="20%" style="box-sizing: border-box; color: #000000; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 15px; line-height: 18px; padding: 10px 0; word-break: break-word;" align="right"><i class="fa fa-inr"></i> <?php echo $response->grand_total;?></td>
                              </tr>
                            </table>                            
                          </td>
                        </tr>
                      </table>
                      <div style=" width:100%; display:block;max-width:80%; clear:both; padding:0 0px 32px 0px; margin:0 auto; background:url(<?php echo $boder;?>) no-repeat top center;">
</div>

<table class="purchase" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; margin: 0; padding: 35px 0; width: 100%;">
                        <tr>
                          <td colspan="2" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; word-break: break-word;">
                            <table class="purchase_content" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; margin: 0; padding: 25px 0 0; width: 100%;">
                              <tr>
                                <th class="purchase_heading" style="border-bottom-color: #EDEFF2; border-bottom-style: solid; border-bottom-width: 1px; box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; padding-bottom: 8px;">
                                  <p style="box-sizing: border-box; color: #9BA2AB; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin: 0;" align="left">Name</p>
                                </th>
                                <th class="purchase_heading" style="border-bottom-color: #EDEFF2; border-bottom-style: solid; border-bottom-width: 1px; box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; padding-bottom: 8px;">
                                  <p class="align-right" style="box-sizing: border-box; color: #9BA2AB; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin: 0;" align="right">Email</p>
                                </th>
                                <th class="purchase_heading" style="border-bottom-color: #EDEFF2; border-bottom-style: solid; border-bottom-width: 1px; box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; padding-bottom: 8px;">
                                  <p class="align-right" style="box-sizing: border-box; color: #9BA2AB; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin: 0;" align="right">Phone Number</p>
                                </th>
                              </tr>
                              <tr>
                                <td width="30%" class="purchase_item" style="box-sizing: border-box; color: #74787E; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 15px; line-height: 18px; padding: 10px 0; word-break: break-word;"><?php echo $response->first_name.' '.$response->last_name;?></td>
                                <td width="40%" class="purchase_item" style="box-sizing: border-box; color: #74787E; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 15px; line-height: 18px; padding: 10px 0; word-break: break-word;"><?php echo $response->email;?></td>
                                 <td width="30%" class="purchase_item" style="box-sizing: border-box; color: #74787E; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 15px; line-height: 18px; padding: 10px 0; word-break: break-word;" align="right"><?php echo $response->phone;?></td>
                              </tr>
                            </table>
                            <table class="purchase_content" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; margin: 0; padding: 25px 0 0; width: 100%;">
                              <tr>
                                <th class="purchase_heading" style="border-bottom-color: #EDEFF2; border-bottom-style: solid; border-bottom-width: 1px; box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; padding-bottom: 8px;">
                                  <p style="box-sizing: border-box; color: #9BA2AB; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin: 0;" align="left">Address</p>
                                </th>
                              </tr>
                              <tr>
                                <td width="100%" class="purchase_item" style="box-sizing: border-box; color: #74787E; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 15px; line-height: 18px; padding: 10px 0; word-break: break-word;"><?php echo $response->address1.' '.$response->address2;?></td>
                              </tr>
                            </table>
                            <table class="purchase_content" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; margin: 0; padding: 25px 0 0; width: 100%;">
                              <tr>
                                <th class="purchase_heading" style="border-bottom-color: #EDEFF2; border-bottom-style: solid; border-bottom-width: 1px; box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; padding-bottom: 8px;">
                                  <p style="box-sizing: border-box; color: #9BA2AB; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin: 0;" align="left">City</p>
                                </th>
                                <th class="purchase_heading" style="border-bottom-color: #EDEFF2; border-bottom-style: solid; border-bottom-width: 1px; box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; padding-bottom: 8px;">
                                  <p style="box-sizing: border-box; color: #9BA2AB; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin: 0;" align="left">Postcode</p>
                                </th>
                                <th class="purchase_heading" style="border-bottom-color: #EDEFF2; border-bottom-style: solid; border-bottom-width: 1px; box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; padding-bottom: 8px;">
                                  <p style="box-sizing: border-box; color: #9BA2AB; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin: 0;" align="left">State</p>
                                </th>
                                <th class="purchase_heading" style="border-bottom-color: #EDEFF2; border-bottom-style: solid; border-bottom-width: 1px; box-sizing: border-box; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; padding-bottom: 8px;">
                                  <p style="box-sizing: border-box; color: #9BA2AB; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin: 0;" align="left">Country</p>
                                </th>                                
                              </tr>
                              <tr>
                              <td width="25%" class="purchase_item" style="box-sizing: border-box; color: #74787E; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 15px; line-height: 18px; padding: 10px 0; word-break: break-word;"><?php echo $response->city;?></td>
                              <td width="25%" class="purchase_item" style="box-sizing: border-box; color: #74787E; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 15px; line-height: 18px; padding: 10px 0; word-break: break-word;"><?php echo $response->post_code;?></td>
                              <td width="25%" class="purchase_item" style="box-sizing: border-box; color: #74787E; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 15px; line-height: 18px; padding: 10px 0; word-break: break-word;"><?php $state = $this->defaultdata->grabStateData(array("state_id" => $response->state_id));echo $state[0]->name;?></td>
                              <td width="25%" class="purchase_item" style="box-sizing: border-box; color: #74787E; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 15px; line-height: 18px; padding: 10px 0; word-break: break-word;"><?php $country = $this->defaultdata->grabCountryData(array("country_id" => $response->country_id));echo $country[0]->name;?></td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
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
