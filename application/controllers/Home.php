<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Home extends CI_Controller {
		
		public $data = array();
		
		public function __construct(){
			parent::__construct();

			$this->load->model('bannerdata');
			$this->load->model('entitydata');
			$this->load->model('userdata');
			$this->load->model('productdata');
			$this->load->model('adsdata');
			$this->load->model('cartdata');
			$this->load->model('orderdata');

			$this->data = $this->defaultdata->getFrontendDefaultData();
		}
		
		public function index()
		{
			//$this->output->cache(60); // Will expire in 60 minutes

			$banner_list = $this->bannerdata->grab_banner(array("status" => 'Y'), array(), array(), array("sort_order" => "desc"));

			$this->data['banner_list'] = $banner_list;

			$products = $this->productdata->grab_product_list();
			$this->data['products'] = $products;

			$enity_list = $this->entitydata->grab_random_entity(array("status" => "Y", "parent_id" => "1", "image_path !=" => ""), array(4, 0));
			$this->data['enity_list'] = $enity_list;

			$ads = $this->adsdata->grab_ads();
			$this->data['ads_list'] = $ads;

			$section = $this->adsdata->grab_ads_section();
			$this->data['section_list'] = $section;

			$this->load->view('home', $this->data); 
		}

		public function save_user_info(){
			$post_data = $this->input->post();
			unset($post_data['user']['id']);
			$post_data['user']['last_login'] = time();
			$post_data['user']['date_added'] = time();

			$user = $this->userdata->grab_user_details(array("email" =>$post_data['user']['email']));

			if(empty($user)){
				$last_id = $this->userdata->insert_user($post_data['user']);
				if($last_id){
					$data['user_id'] = $last_id;
					$data['email'] = $post_data['user']['email'];

					$this->defaultdata->setFrontendLoginSession((object)$data);

					$response['success'] = true;
					$response['msg'] = "You have successfully registered & logged in.";
				}
			}else{
				$this->userdata->update_user_details(array("user_id" => $user[0]->user_id), array("last_login" => time()));

				$this->defaultdata->setFrontendLoginSession($user[0]);

				$response['success'] = true;
				$response['msg'] = "You have logged in successfully";
			}

			echo json_encode($response);
		}

		public function register(){
			$post_data = $this->input->post();
			$general_settings = $this->data['general_settings'];
			$admin_profile = $this->data['admin_profile'];
				
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|is_unique['.TABLE_USER.'.email]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[20]');
			$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');
			$this->form_validation->set_rules('phone', 'Mobile No', 'trim|required|exact_length[10]');

			if($this->form_validation->run() == FALSE)
			{					
				$response['success'] = false;
				$response['msg'] = validation_errors();
			}else{
				unset($post_data['confirm_password']);

				$post_data['password'] = base64_encode(hash("sha256", $post_data['password'], True));
				$post_data['date_added'] = time();

				$this->userdata->insert_user($post_data);

				$response['success'] = true;
				$response['msg'] = "You have registered successfully. Please login to continue.";

				// an email should be sent to user			
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

				$this->data['first_name'] = $post_data['first_name'];
				
				$message = $this->load->view('email_template/register', $this->data, true);
				$mail_config = array(
					"from" => $admin_profile->email,
					"to" => array($post_data['email']),
					"subject" => $general_settings->sitename.": New Registration",
					"message" => $message
				);
				
				$this->defaultdata->_send_mail($mail_config);
			}

			echo json_encode($response);
		}

		public function login(){
			$post_data = $this->input->post();
				
			$this->load->library('form_validation');

			$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if($this->form_validation->run() == FALSE)
			{					
				$response['success'] = false;
				$response['msg'] = validation_errors();
			}else{
				$email = $post_data['email'];
				$given_password = $post_data['password'];
				$encrypted_password = base64_encode(hash("sha256", $post_data['password'], True));

				$user = $this->userdata->grab_user_details(array("email" => $email, "password" => $encrypted_password));

				if(!empty($user)){
					if($user[0]->status == 'N'){
						$response['success'] = false;
						$response['msg'] = "Sorry, Your account deactivated.";
					}else{						
						if($this->userdata->update_user_details(array("user_id" => $user[0]->user_id), array("last_login" => time()))){
							
							$this->defaultdata->setFrontendLoginSession($user[0]);

							$response['success'] = true;
							$response['msg'] = "Login Successful.";
						}						
					}
				}else{
					$response['success'] = false;
					$response['msg'] = "Invalid Login. Please try again later.";
				}				
			}

			echo json_encode($response);
		}

		public function hasSameEmailAddress($email){
			$user_data = $this->userdata->grab_user_details(array("email" => $email));
			if(count($user_data) > 0){
				return true;				
			}else{
				$this->form_validation->set_message('hasSameEmailAddress', 'The given email address does not exists');
				return false;
			}
		}

		public function forget_password(){
			$post_data = $this->input->post();
			$general_settings = $this->data['general_settings'];
			$admin_profile = $this->data['admin_profile'];
				
			$this->load->library('form_validation');

			$this->form_validation->set_rules('email', 'Email Address', 'callback_hasSameEmailAddress');

			if($this->form_validation->run() == FALSE)
			{					
				$response['success'] = false;
				$response['msg'] = validation_errors();
			}else{
				$given_password = $this->defaultdata->getGeneratedPassword();
				$encrypted_password = base64_encode(hash("sha256", $given_password, True));

				$user = $this->userdata->grab_user_details(array("email" => $post_data['email']));

				if($this->userdata->update_user_details(array("user_id" => $user[0]->user_id), array("password" => $encrypted_password, "date_modified" => time()))){

					$response['success'] = true;
					$response['msg'] = "You have successfully reset your password. A new password generated & sent to your given email address. Please check your inbox to get your login credential.";

					// an email should be sent to user			
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

					$this->data['first_name'] = $user[0]->first_name;
					$this->data['email'] = $post_data['email'];
					$this->data['password'] = $given_password;
					
					$message = $this->load->view('email_template/forget', $this->data, true);
					$mail_config = array(
						"from" => $admin_profile->email,
						"to" => array($post_data['email']),
						"subject" => $general_settings->sitename.": Password Recovery",
						"message" => $message
					);
					
					$this->defaultdata->_send_mail($mail_config);
				}
			}

			echo json_encode($response);
		}

		public function logout(){
			$this->defaultdata->unsetFrontendLoginSession();
			
			redirect(base_url());
		}

		public function cms(){
			$cms = $this->data['tot_segments'][1];
			$cond['mode'] = $cms;			
			$cms_data = $this->userdata->get_cms_content($cond);

			$this->data['cms_data'] = $cms_data;

			$this->load->library('breadcrumb');

			$this->breadcrumb->add('Home', base_url());
			$this->breadcrumb->add($cms_data->title, base_url($cms)); 

			$this->data['breadcrumb'] = $this->breadcrumb->output();

			$this->load->view('cms', $this->data);
		}

		public function open_modal(){
			$post_data = $this->input->post();

			echo $this->load->view('partials/'.$post_data['mode'], $this->data, true);
		}

		public function subscribe_newsletter(){
			$post_data = $this->input->post();

			if(!$this->defaultdata->checkEmailFormat($post_data['email'])){
				$response["success"] = false;
				$response["msg"] = 'Please enter valid email address';
			}else{
				$email = $this->userdata->get_newsletter(array("email" => $post_data['email']));			
				if(empty($email)){
					if($this->userdata->insert_newsletter(array("email" => $post_data['email'], "date_added" => time()))){
						$response["success"] = true;
						$response["msg"] = 'Thank you for subscribing with us';
					}
				}else{
					$response["success"] = false;
					$response["msg"] = 'You are already subscribed with us';
				}
			}

			echo json_encode($response);
		}

		public function myaccount(){			
			$this->load->library('breadcrumb');

			$this->breadcrumb->add('Home', base_url());
			$this->breadcrumb->add('My Account', base_url('myaccount')); 

			$this->data['breadcrumb'] = $this->breadcrumb->output();
			$this->data['sidebar'] = $this->load->view('partials/sidebar', null, true);

			if($this->session->userdata('has_error')){
				$user = (object)$this->session->userdata;
				$this->data['user'] = $user;
			}else{
				$user = $this->userdata->grab_user_details(array("user_id" => $this->session->userdata('user_id')));
				$user = $user[0];
				$this->data['user'] = $user;
			}

			if($user->country_id){
				$states = $this->defaultdata->grabStateData(array("country_id" => $user->country_id));
				$this->data['states'] = $states;
			}

			$country = $this->defaultdata->grabCountryData();
			$this->data['country'] = $country;

			$this->load->view('myaccount', $this->data);
		}

		public function get_state_by_country(){
			$post_data = $this->input->post();

			$states = $this->defaultdata->grabStateData(array("country_id" => $post_data['country_id']));
			
			if(!empty($states)){
				foreach ($states as $state) {
					echo '<option value="'.$state->state_id.'">'.$state->name.'</option>';
				}
			}
		}

		public function update_account(){
			$post_data = $this->input->post();

			if($post_data['email'] != $post_data['old_email']){
				$is_unique =  '|is_unique['.TABLE_USER.'.email]';
			}else{
				$is_unique =  '';
			}

			if($post_data['phone'] != $post_data['old_phone']){
				$is_unique1 =  '|is_unique['.TABLE_USER.'.phone]';
			}else{
				$is_unique1 =  '';
			}				
				
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('email', 'E-mail', 'trim|required'.$is_unique);
			$this->form_validation->set_rules('phone', 'Phone', 'trim|required'.$is_unique1);
			$this->form_validation->set_rules('address1', 'Address1', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('post_code', 'Post Code', 'trim|required');
			$this->form_validation->set_rules('country_id', 'Country', 'trim|required');
			$this->form_validation->set_rules('state_id', 'State', 'trim|required');
			
			$this->session->unset_userdata($post_data);
			if($this->form_validation->run() == FALSE)
			{	
				$this->session->set_userdata($post_data);
				$this->session->set_userdata('has_error', true);
				$this->session->set_userdata('myaccount_notification', validation_errors());
			}else{
				unset($post_data['old_email']);
				unset($post_data['old_phone']);

				$post_data['date_modified'] = time();
				
				$this->userdata->update_user_details(array("user_id" => $this->session->userdata('user_id')), $post_data);

				$this->session->set_userdata('has_error', false);
				$this->session->set_userdata('myaccount_notification', "Your account updated successfully");
			}
			redirect($this->agent->referrer());
		}

		public function orderhistory(){
			$this->load->library('breadcrumb');

			$this->breadcrumb->add('Home', base_url());
			$this->breadcrumb->add('Order History', base_url('orderhistory')); 

			$order_data = $this->orderdata->fetch_order_list();

			if(!empty($order_data)){
				$count = 0;
				foreach ($order_data as $key => $value) {
					$order_details = unserialize(json_decode($value->order_data));

					if(!empty($order_details)){
						foreach ($order_details as $key1 => $value1) {
							$order_result[$count]['orderid'] = $value->orderid;
							$order_result[$count]['date_added'] = $value->date_added;
							$order_result[$count]['order_status'] = $value->order_status;
							$order_result[$count]['name'] = $value1->prd_name;
							$order_result[$count]['sub_total'] = $value1->prd_price;

							$prd_img = $this->productdata->grab_product_image(array("product_id" => $value1->product_id, "is_featured" => 'Y'));
							$order_result[$count]['prd_name'] = $prd_img[0]->name;

							$count++;
						}
					}
				}
			}

			$this->data['order_data'] = $order_result;
			$this->data['breadcrumb'] = $this->breadcrumb->output();
			$this->data['sidebar'] = $this->load->view('partials/sidebar', null, true);
			
			$this->load->view('orderhistory', $this->data);
		}

		public function remove_from_wishlist(){
			$post_data = $this->input->post();

			$product_id = $post_data['data'];

			$this->userdata->delete_wishlist(array("product_id" => $product_id, "user_id" => $this->session->userdata('user_id')));

			$response['status'] = true;
			$response['msgText'] = "Selected item deleted from wishlist";

			echo json_encode($response);
		}

		public function add_to_wishlist(){
			$post_data = $this->input->post();

			$product_id = $post_data['data'];

			$wishlist_data = $this->userdata->grab_wishlist(array("product_id" => $product_id, "user_id" => $this->session->userdata('user_id')));

			if(!empty($wishlist_data)){
				$response['status'] = false;
				$response['msgText'] = "Item already added to wishlist";
			}else{
				if($this->userdata->insert_wishlist(array("product_id" => $product_id, "user_id" => $this->session->userdata('user_id'), "date_added" => time()))){
					$response['status'] = true;
					$response['msgText'] = "Item added to wishlist successfully";
				}else{
					$response['status'] = false;
					$response['msgText'] = "Something went wrong";
				}
			}

			echo json_encode($response);
		}

		public function load_wishlist(){
			$this->data['wishlist_data'] = $this->userdata->grab_product_wishlist_list();

			echo $this->load->view('partials/wishlist', $this->data, true);
		}

		public function mywishlist(){
			$this->load->library('breadcrumb');

			$this->breadcrumb->add('Home', base_url());
			$this->breadcrumb->add('My Wishlist', base_url('mywishlist')); 

			$this->data['breadcrumb'] = $this->breadcrumb->output();
			$this->data['sidebar'] = $this->load->view('partials/sidebar', null, true);
			
			$this->load->view('mywishlist', $this->data);
		}

		public function contact(){
			$this->load->library('breadcrumb');
			$this->breadcrumb->add('Home', base_url());
			$this->breadcrumb->add('Contact Us', base_url('contact')); 
			$this->data['breadcrumb'] = $this->breadcrumb->output();

			$this->load->view('contact', $this->data);
		}

		public function add_contact(){
			$post_data = $this->input->post();
			$general_settings = $this->data['general_settings'];
			$admin_profile = $this->data['admin_profile'];

			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('fullname', 'Full Name', 'trim|required');
			$this->form_validation->set_rules('phonenumber', 'Phone Number', 'trim|required|numeric|exact_length[10]');
			$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
			$this->form_validation->set_rules('message', 'Message', 'trim|required');
			
			$this->session->unset_userdata($post_data);
			if($this->form_validation->run() == FALSE)
			{	
				$this->session->set_userdata($post_data);
				$this->session->set_userdata('has_error', true);
				$this->session->set_userdata('contact_notification', validation_errors());
			}else{
				// send mail to admin		
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
				
				$this->data['first_name'] = ucfirst($admin_profile->username);
				$this->data['fullname'] = $post_data['fullname'];
				$this->data['phonenumber'] = $post_data['phonenumber'];
				$this->data['email'] = $post_data['email'];
				$this->data['message'] = $post_data['message'];
				
				$message = $this->load->view('email_template/contact', $this->data, true);
				$mail_config = array(
					"from" => $admin_profile->email,
					"to" => array($admin_profile->email),
					"subject" => $general_settings->sitename.": Contact Us",
					"message" => $message
				);
				
				$this->defaultdata->_send_mail($mail_config);

				$this->session->set_userdata('has_error', false);
				$this->session->set_userdata('contact_notification', "Your message has been received. We will catch you shortly. Please stay in touch.");
			}
			redirect($this->agent->referrer());
		}

		public function changepassword(){
			$this->load->library('breadcrumb');

			$this->breadcrumb->add('Home', base_url());
			$this->breadcrumb->add('Change Password', base_url('changepassword')); 

			$this->data['breadcrumb'] = $this->breadcrumb->output();
			$this->data['sidebar'] = $this->load->view('partials/sidebar', null, true);
			
			$this->load->view('changepassword', $this->data);
		}

		public function update_password(){
			$post_data = $this->input->post();
				
			$this->load->library('form_validation');

			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[20]');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');
			
			$this->session->unset_userdata($post_data);
			if($this->form_validation->run() == FALSE)
			{	
				$this->session->set_userdata($post_data);
				$this->session->set_userdata('has_error', true);
				$this->session->set_userdata('password_notification', validation_errors());
			}else{
				unset($post_data['confirm_password']);
				$post_data['password'] = base64_encode(hash("sha256", $post_data['password'], True));
				$post_data['date_modified'] = time();
				
				$this->userdata->update_user_details(array("user_id" => $this->session->userdata('user_id')), $post_data);

				$this->session->set_userdata('has_error', false);
				$this->session->set_userdata('password_notification', "Your password updated successfully");
			}
			redirect($this->agent->referrer());
		}
	}
?>