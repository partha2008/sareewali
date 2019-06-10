<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	$config['site_info'] = array(
		"email_smtp_host" => "localhost",
		"email_smtp_port" => "25",
		"smtp_email" => "",
		"smtp_password" => "",
		"payment_api_key" => "117CEDE6DED4148885BC81FF3CC8E9",
		"payment_order_api" => "https://axisbank.juspay.in/orders",
		"payment_order_status_api" => "https://axisbank.juspay.in/order_status",
		"merchantId" => "SAREEAK_test",
		"ccavenue_merchant_id" => "221104",
		"ccavenue_access_code" => "AVXT85GF75AF06TXFA",
		"ccavenue_working_key" => "FC60017733D91CA00B74D3A9CDE6E058",
		"ccavenue_test_url" => "https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction",
		"ccavenue_live_url" => "https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"
	);
	
	// Bootstrap Pagination Configuration
	$config['pagination']['per_page'] = PAGINATION_PER_PAGE;
	$config['pagination']["uri_segment"] = 3;
	$config['pagination']["num_links"] = 2;
	
	$config['pagination']['use_page_numbers'] = TRUE;
	$config['pagination']['page_query_string'] = TRUE;
	$config['pagination']['query_string_segment'] = 'page';
	$config['pagination']['reuse_query_string'] = TRUE;
	
	$config['pagination']['full_tag_open'] = '<ul class="pagination">';
	$config['pagination']['full_tag_close'] = '</ul>';

	$config['pagination']['first_link'] = '&laquo; First';
	$config['pagination']['first_tag_open'] = '<li class="prev page">';
	$config['pagination']['first_tag_close'] = '</li>';

	$config['pagination']['last_link'] = 'Last &raquo;';
	$config['pagination']['last_tag_open'] = '<li class="next page">';
	$config['pagination']['last_tag_close'] = '</li>';

	$config['pagination']['next_link'] = 'Next &rarr;';
	$config['pagination']['next_tag_open'] = '<li class="next page">';
	$config['pagination']['next_tag_close'] = '</li>';

	$config['pagination']['prev_link'] = '&larr; Previous';
	$config['pagination']['prev_tag_open'] = '<li class="prev page">';
	$config['pagination']['prev_tag_close'] = '</li>';

	$config['pagination']['cur_tag_open'] = '<li class="active"><a href="">';
	$config['cur_tag_close'] = '</a></li>';

	$config['pagination']['num_tag_open'] = '<li class="page">';
	$config['pagination']['num_tag_close'] = '</li>';

	$config['pagination']['anchor_class'] = 'follow_link';
	// Ends
	
	// SMTP configuration
	$config['smtp']['protocol'] = "sendmail";
	$config['smtp']['smtp_host'] = "localhost";
	$config['smtp']['smtp_port'] = "25";
	$config['smtp']['smtp_user'] = ""; 
	$config['smtp']['smtp_pass'] = "";
	$config['smtp']['charset'] = "iso-8859-1";
	$config['smtp']['mailtype'] = "html";
	$config['smtp']['newline'] = "\r\n";
	
	// Months array
	$config['month'][] = 'January'; 
	$config['month'][] = 'February'; 
	$config['month'][] = 'March'; 
	$config['month'][] = 'April'; 
	$config['month'][] = 'May'; 
	$config['month'][] = 'June'; 
	$config['month'][] = 'July'; 
	$config['month'][] = 'August'; 
	$config['month'][] = 'Sepetember'; 
	$config['month'][] = 'October'; 
	$config['month'][] = 'November'; 
	$config['month'][] = 'December';

	// Different units for the product
	$config['unit']['gm'] = 'Gram';
	$config['unit']['kg'] = 'Kilogram';
	$config['unit']['cm'] = 'Centimeter';
	$config['unit']['m'] = 'Meter';
	$config['unit']['in'] = 'Inch';
	$config['unit']['ft'] = 'Foot';

	// Fabric array
	$config['fabric'][1] = 'Art Silk'; 
	$config['fabric'][2] = 'Benarasi Silk'; 
	$config['fabric'][3] = 'Chiffon'; 
	$config['fabric'][4] = 'Chiffon Satin'; 
	$config['fabric'][5] = 'Cotton Silk'; 
	$config['fabric'][6] = 'Crepe'; 
	$config['fabric'][7] = 'Fancy Fabric'; 
	$config['fabric'][8] = 'Faux Chiffon'; 
	$config['fabric'][9] = 'Georgette'; 
	$config['fabric'][10] = 'Jacquard'; 
	$config['fabric'][11] = 'Jacquard Silk'; 
	$config['fabric'][12] = 'Lycra';
	$config['fabric'][13] = 'Net';
	$config['fabric'][14] = 'Patola Silk';
	$config['fabric'][15] = 'Satin';
	$config['fabric'][16] = 'Silk';
	$config['fabric'][17] = 'Two Tone Silk';

	// Occassion array
	$config['occassion'][1] = 'Bridal'; 
	$config['occassion'][2] = 'Casual'; 
	$config['occassion'][3] = 'Ceremonial'; 
	$config['occassion'][4] = 'Festival'; 
	$config['occassion'][5] = 'Party'; 
	$config['occassion'][6] = 'Reception'; 
	$config['occassion'][7] = 'Sangeet'; 
	$config['occassion'][8] = 'Wedding'; 

	// Shipping Status
	$config['order_status'][1] = array("text" => "Received", "class" => "text-primary"); 
	$config['order_status'][2] = array("text" => "Processed", "class" => "text-success"); 
	$config['order_status'][3] = array("text" => "Dispatched", "class" => "text-warning"); 
	$config['order_status'][4] = array("text" => "Delivered", "class" => "text-danger");
	$config['order_status'][5] = array("text" => "Cancelled", "class" => "text-danger");  