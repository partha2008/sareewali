<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller{
	
	public $data = array();
	public $loggedin_method_arr = array('order-list');
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('orderdata');
		$this->load->model('userdata');
		$this->load->model('productdata');
			
		$this->data = $this->defaultdata->getBackendDefaultData();
		
		if(in_array($this->data['tot_segments'][1], $this->loggedin_method_arr))
		{
			if($this->defaultdata->is_session_active() == 0)
			{
				redirect(base_url());
			}
		}
	}
	
	public function order_list(){		
		$search_key = $this->input->get('query');
		$like = array(
			"first_name" => $search_key,
			"last_name" => $search_key,
			"orderid" => $search_key,
			"transaction_id" => $search_key,
			"payment_type" => $search_key
		);
		if(isset($search_key) && $search_key){
			$this->data['search_key'] = $search_key;
		}else{
			$this->data['search_key'] = '';
		}
		
		$order_data = $this->orderdata->grab_order(array(), $like, array());
		
		//pagination settings
		$config['base_url'] = base_url('admin/order-list');
		$config['total_rows'] = count($order_data);
		
		$pagination = $this->config->item('pagination');
		
		$pagination = array_merge($config, $pagination);

		$this->pagination->initialize($pagination);
		$this->data['page'] = ($this->input->get('page')) ? $this->input->get('page') : 0;		

		$this->data['pagination'] = $this->pagination->create_links();
		
		$order_paginated_data = $this->orderdata->grab_order(array(), $like, array(PAGINATION_PER_PAGE, $this->data['page']), true);
		$this->data['order_details'] = $order_paginated_data;
		
		$this->load->view('admin/order_list', $this->data); 
	}

	public function resend_mail($order_id, $user_id){
		$general_settings = $this->data['general_settings'];
		$admin_profile = $this->data['admin_profile'];

		$this->data['site_title'] = rtrim(preg_replace("(^https?://www.)", "",$general_settings->siteaddress), '/');
		$this->data['site_logo'] = UPLOAD_LOGO_PATH.$general_settings->logoname;
		$this->data['site_url'] = $general_settings->siteaddress;
		$this->data['site_name'] = $general_settings->sitename;					
		$this->data['fb_img'] = base_url('resources/images/facebook.jpg'); 
		$this->data['fb_link'] = $general_settings->facebook_page_url; 
		$this->data['tw_img'] = base_url('resources/images/twitter.jpg');
		$this->data['tw_link'] = ''; 
		$this->data['email_banner'] = base_url('resources/images/email-banner.jpg');
		$this->data['boder'] = base_url('resources/images/boder.jpg');	

		$user = $this->userdata->grab_user_details(array("user_id" => $user_id));
		$order_data = $this->orderdata->grab_order(array("order_id" => $order_id));
		$cart_data = $this->orderdata->grab_order_details(array("order_id" => $order_id));

		if(!empty($user)){
			$first_name = $user[0]->first_name;
			$user_email = $user[0]->email;
		}else{
			$first_name = $order_data[0]->first_name;
			$user_email = $order_data[0]->email;
		}
		
		$this->data['name'] = $first_name;
		$this->data['cart_data'] = unserialize(json_decode($cart_data[0]->order_data));
		$this->data['response'] = $order_data[0];
		
		$message = $this->load->view('email_template/order', $this->data, true);

		// send mail to user	
		$mail_config = array(
			"from" => $admin_profile->email,
			"to" => array($user_email),
			"subject" => $general_settings->sitename.": New Order",
			"message" => $message
		);
		
		if($this->defaultdata->_send_mail($mail_config)){
			$this->session->set_userdata('order_mail_notification', "Email for order #".$order_data[0]->orderid." has been sent successfully.");

			redirect(base_url('admin/order-list'));
		}
	}

	public function order_details($order_id){		
		$order_data = $this->orderdata->grab_order(array("order_id" => $order_id));
		$order_details_data = $this->orderdata->grab_order_details(array("order_id" => $order_id));

		$this->data['order_data'] = $order_data[0];
		$this->data['order_details_data'] = unserialize(json_decode($order_details_data[0]->order_data));

		$this->load->view('admin/order_details', $this->data); 
	}

	public function update_order(){
		$post_data = $this->input->post();

		$this->orderdata->update_order(array("order_id" => $post_data['order_id']), array("order_status" => $post_data['order_status'], "date_modified" => time()));

		redirect(base_url('admin/order-list'));
	}

	public function generate_invoice($order_id){
		$this->load->helper('pdf_helper');

		$order_data = $this->orderdata->grab_order(array("order_id" => $order_id));
		$order_details_data = $this->orderdata->grab_order_details(array("order_id" => $order_id));
		$invoice_name = str_replace('SW', 'INV', $order_data[0]->orderid).".pdf";
		$invoice_date = time();

		$this->orderdata->update_order(array("order_id" => $order_id), array("invoice_generated" => "Y", "invoice_name" => $invoice_name, "invoice_generated_on" => $invoice_date));

		$this->data['order_data'] = $order_data[0];
		$this->data['order_details_data'] = unserialize(json_decode($order_details_data[0]->order_data));
		$this->data['invoice_name'] = $invoice_name;
		$this->data['invoice_date'] = $invoice_date;

		$this->load->view('admin/pdfreport', $this->data);

		$this->session->set_userdata('order_mail_notification', "Invoice for order #".$order_data[0]->orderid." has been generated.");

		redirect(base_url('admin/order-list'));
	}

	public function send_invoice($order_id, $user_id){
		$general_settings = $this->data['general_settings'];
		$admin_profile = $this->data['admin_profile'];

		$this->data['site_title'] = rtrim(preg_replace("(^https?://www.)", "",$general_settings->siteaddress), '/');
		$this->data['site_logo'] = UPLOAD_LOGO_PATH.$general_settings->logoname;
		$this->data['site_url'] = $general_settings->siteaddress;
		$this->data['site_name'] = $general_settings->sitename;					
		$this->data['fb_img'] = base_url('resources/images/facebook.jpg'); 
		$this->data['fb_link'] = $general_settings->facebook_page_url; 
		$this->data['tw_img'] = base_url('resources/images/twitter.jpg');
		$this->data['tw_link'] = ''; 
		$this->data['email_banner'] = base_url('resources/images/email-banner.jpg');
		$this->data['boder'] = base_url('resources/images/boder.jpg');	

		$user = $this->userdata->grab_user_details(array("user_id" => $user_id));
		$order_data = $this->orderdata->grab_order(array("order_id" => $order_id));
		if(!empty($user)){
			$first_name = $user[0]->first_name;
			$user_email = $user[0]->email;
		}else{
			$first_name = $order_data[0]->first_name;
			$user_email = $order_data[0]->email;
		}
		
		$this->data['first_name'] = $first_name;
		$this->data['order_data'] = $order_data[0];
		
		$message = $this->load->view('admin/email_template/invoice', $this->data, true);

		// send mail to user	
		$mail_config = array(
			"from" => $admin_profile->email,
			"to" => array($user_email),
			"subject" => $general_settings->sitename.": Invoice for Order #".$order_data[0]->orderid,
			"message" => $message,
			"attachment" => UPLOAD_RELATIVE_INVOICE_PATH.$order_data[0]->invoice_name
		);
		
		if($this->defaultdata->_send_mail($mail_config)){
			$this->session->set_userdata('order_mail_notification', "Invoice for order #".$order_data[0]->orderid." has been sent successfully.");

			redirect(base_url('admin/order-list'));
		}
	}
}