<?php

	defined('BASEPATH') OR exit('No direct script access allowed');



	class User extends CI_Controller {

		

		public $data = array();

		public $loggedin_method_arr = array('dashboard', 'profile', 'settings', 'user-list', 'user-add', 'user-edit', 'banner-list', 'banner-add', 'banner-edit', 'entity-list', 'entity-add', 'entity-edit', 'product-list', 'product-add', 'product-edit', 'term', 'privacy', 'return', 'shipping', 'about', 'feedback', 'newsletter', 'ads');



		public $loggedout_method_arr = array('index');

		

		public function __construct(){

			parent::__construct();

			

			$this->load->model('userdata');

			$this->load->model('adsdata');

			

			$this->data = $this->defaultdata->getBackendDefaultData();

			

			if(in_array($this->data['tot_segments'][2], $this->loggedin_method_arr))

			{

				if($this->defaultdata->is_session_active() == 0)

				{

					redirect(base_url('admin'));

				}

			}

			

			if(in_array($this->data['tot_segments'][2], $this->loggedout_method_arr))

			{

				if($this->defaultdata->is_session_active() == 1)

				{

					redirect(base_url('admin/dashboard'));

				}

			}

		}

		

		public function index()

		{			

			$this->load->view('admin/login', $this->data); 

		}

		

		public function process_login(){

			$post_data = $this->input->post();

			

			$this->load->library('form_validation');

			$this->form_validation->set_rules('username', 'Username', 'trim|required');

			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			

			if($this->form_validation->run() == FALSE)

			{	

				$this->session->set_userdata('login_error', 'true');

				redirect(base_url('admin'));

			}

			else

			{

				$username = $post_data['username'];

				$password = $post_data['password'];

				

				$encrypted_password = base64_encode(hash("sha256", $password, True));

				

				$data = array(

					"username" => $username,

					"password" => $encrypted_password

				);

				

				$user_data = $this->userdata->grab_backend_user_details($data);

				if(count($user_data) > 0){

					if($user_data[0]->is_active){

						$this->defaultdata->setLoginSession($user_data[0]);

						redirect(base_url('admin/dashboard'));	

					}else{

						$this->session->set_userdata('login_error', 'true');

						$this->session->set_userdata('login_error_msg', 'You have been deactivated!');

						redirect(base_url('admin'));

					}									

				}else{

					$this->session->set_userdata('login_error', 'true');

					$this->session->set_userdata('login_error_msg', 'Incorrect Username/Password. Please try again!');

					redirect(base_url('admin'));					

				}

			}

		}

		

		public function dashboard(){

			$this->load->view('admin/dashboard', $this->data);

		}

		

		public function forget_password(){

			if($this->session->userdata('has_error')){

				$this->data['forget_details'] = (object)$this->session->userdata;

			}

			$this->load->view('admin/forget', $this->data);

		}

		

		public function process_forget(){

			$post_data = $this->input->post();

			$general_settings = $this->data['general_settings'];

			$admin_profile = $this->data['admin_profile'];

			

			$email = $post_data['email'];

			

			$this->load->library('form_validation');

			

			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

			

			$this->session->unset_userdata($post_data);

			if($this->form_validation->run() == FALSE)

			{	

				$this->session->set_userdata($post_data);

				

				$this->session->set_userdata('has_error', true);

				$this->session->set_userdata('forget_notification', validation_errors());

			}else{			

				// check for email existense

				$user_data = $this->userdata->grab_backend_user_details(array("email" => $email));

				if(!empty($user_data)){

					$password = $this->defaultdata->getGeneratedPassword(8);

					$this->userdata->update_backend_user_details(array("email" => $email), array("password" => $this->defaultdata->getSha256Base64Hash($password), "original_password" => $password));

					

					// Send mail to admin for password recovery

					$this->data['site_title'] = rtrim(preg_replace("(^https?://www.)", "",$general_settings->siteaddress), '/');

					$this->data['site_logo'] = UPLOAD_LOGO_PATH.$general_settings->logoname;

					$this->data['site_url'] = $general_settings->siteaddress;

					$this->data['site_name'] = $general_settings->sitename;					

					$this->data['fb_img'] = base_url('assets/images/facebook.jpg'); 

					$this->data['fb_link'] = $general_settings->facebook_page_url; 

					$this->data['tw_img'] = base_url('assets/images/twitter.jpg');

					$this->data['tw_link'] = ''; 

					$this->data['email_banner'] = base_url('resources/images/email-banner.jpg');

					$this->data['boder'] = base_url('assets/images/boder.jpg');



					$this->data['first_name'] = ucfirst($user_data[0]->username);

					$this->data['email'] = $email;

					$this->data['password'] = $password;

					

					$message = $this->load->view('email_template/forget', $this->data, true);

					$mail_config = array(

						"from" => $email,

						"to" => array($email),

						"subject" => $general_settings->sitename.": Password Recovery",

						"message" => $message

					);

					

					$this->defaultdata->_send_mail($mail_config);

					// Ends	

					

					$this->session->set_userdata('has_error', false);

					$this->session->set_userdata('forget_notification', 'Password has been reset. New Password has been generated. An email has been sent to the given email address to get the login details');

				}else{

					$this->session->set_userdata($post_data);

					

					$this->session->set_userdata('has_error', true);

					$this->session->set_userdata('forget_notification', 'The given email address does not exist');

				}

			}

			redirect($this->agent->referrer());

		}

		

		public function profile(){

			$data = array();

			$data['admin_id'] = $this->session->usrid;

			$user_data = $this->userdata->grab_backend_user_details($data);

			

			if($this->session->userdata('has_error')){

				$this->data['profile_data'] = (object)$this->session->userdata;

			}else{

				$this->data['profile_data'] = $user_data[0];

			}

			

			$this->load->view('admin/profile', $this->data);

		}

		

		public function process_profile(){

			$post_data = $this->input->post();

			

			$username = $post_data['username'];

			$old_username = $post_data['old_username'];

			$password = $post_data['password'];

			$original_password = $post_data['original_password'];

			$email = $post_data['email'];

			$contact_no = $post_data['contact_no'];

			$address = $post_data['address'];

			$old_email = $post_data['old_email'];

			$is_active = $post_data['is_active'];

			

			$this->load->library('form_validation');

			

			$this->form_validation->set_rules('username', 'Username', 'trim|required');

			if($username != $old_username){

				$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique['.TABLE_ADMIN.'.username]');

			}

			if($password){

				$this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]|max_length[20]');

			}else{

				$password = $original_password;

			}

			if($email != $old_email){

				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique['.TABLE_ADMIN.'.email]');

			}

			

			$this->session->unset_userdata($post_data);

			if($this->form_validation->run() == FALSE)

			{	

				$this->session->set_userdata($post_data);

				$this->session->set_userdata('has_error', true);

				$this->session->set_userdata('profile_notification', validation_errors());

			}else{				

				$encrypted_password = base64_encode(hash("sha256", $password, True));

				

				$cond = array("admin_id" => $this->session->usrid);

				$data = array(

					"username" => $username,

					"password" => $encrypted_password,

					"original_password" => $password,

					"email" => $email,

					"contact_no" => $contact_no,

					"address" => $address,

					"is_active" => $is_active

				);

				

				$this->userdata->update_backend_user_details($cond, $data);

				

				$this->session->set_userdata('has_error', false);

				$this->session->set_userdata('profile_notification', 'Profile changes have been saved successfully.');

			}

			

			redirect($this->agent->referrer());

		}

		

		public function settings(){		

			if($this->session->userdata('has_error')){

				$this->data['settings_data'] = (object)$this->session->userdata;

			}else{

				$this->data['settings_data'] = $this->defaultdata->grabSettingData();

			}

			

			$this->load->view('admin/settings', $this->data);

		}

		

		public function process_settings(){

			

			$post_data = $this->input->post();

			

			$this->load->library('form_validation');

			

			$this->form_validation->set_rules('sitename', 'Sitename', 'trim|required');

			$this->form_validation->set_rules('siteaddress', 'Siteaddress', 'trim|required');

			$this->form_validation->set_rules('facebook_page_url', 'Facebook Page URL', 'trim|required');

			$this->form_validation->set_rules('gst_no', 'GST Reg No', 'trim|required');



			$this->session->unset_userdata($post_data);

			if($this->form_validation->run() == FALSE)

			{	

				$this->session->set_userdata($post_data);

				$this->session->set_userdata('has_error', true);

				$this->session->set_userdata('settings_notification', validation_errors());

			}else{

				$data = array(

					"sitename" => $post_data['sitename'],

					"siteaddress" => $post_data['siteaddress'],

					"facebook_page_url" => $post_data['facebook_page_url'],

					"gst_no" => $post_data['gst_no'],

					"date_added" => time()

				);

				

				if(isset($_FILES) && $_FILES['logo']['error'] == 0){

					$filename = $_FILES['logo']['name'];

					$file_ext = pathinfo($filename, PATHINFO_EXTENSION);

					$file_name = 'logo'.'.'.$file_ext;

					

					array_map('unlink', glob(UPLOAD_RELATIVE_LOGO_PATH."*"));

					if(move_uploaded_file($_FILES['logo']['tmp_name'], UPLOAD_RELATIVE_LOGO_PATH.$file_name)){

						$data['logoname'] = $file_name;

						$data['logopathname'] = UPLOAD_RELATIVE_LOGO_PATH.$file_name;

					}

				}

				

				$cond = array("settings_id" => $post_data['settings_id']);

				

				$this->userdata->update_settings_details($cond, $data);

				

				$this->session->set_userdata('has_error', false);

				$this->session->set_userdata('settings_notification', 'Settings changes have been saved successfully.');

			}

			

			redirect($this->agent->referrer());			

		}

		

		public function cms(){

			$cms = $this->data['tot_segments'][2];

			if($this->session->userdata('has_error')){

				$this->data['cms_data'] = (object)$this->session->userdata;

			}else{

				$cond['mode'] = $cms;

				$this->data['cms_data'] = $this->userdata->get_cms_content($cond);

			}

			if($cms == 'term'){

				$title = "Terms & Conditions";

			}else{

				$title = "Privacy & Policy";

			}

			$this->data['title'] = $title;

			$this->load->view('admin/cms', $this->data);

		}

		

		public function update_cms(){

			$post_data = $this->input->post();

			

			$this->load->library('form_validation');

			

			$this->form_validation->set_rules('title', 'Title', 'trim|required');			

			$this->form_validation->set_rules('description', 'Description', 'trim|required');			

			

			$this->session->unset_userdata($post_data);

			if($this->form_validation->run() == FALSE)

			{	

				$this->session->set_userdata($post_data);

				

				$this->session->set_userdata('has_error', true);

				$this->session->set_userdata('cms_notification', validation_errors());

				

				redirect($this->agent->referrer());

			}else{

				$cond['mode'] = $post_data['mode'];

				$data = array(

					"title" => $post_data['title'],

					"description" => $post_data['description'],

					"date_added" => time()

				);

				$this->userdata->update_cms_content($cond, $data);

				

				$this->session->set_userdata('has_error', false);

				

				redirect(base_url('admin/'.$post_data['mode']));

			}

		}

		

		public function user_list()

		{

			$like = array();

			parse_str($_SERVER['QUERY_STRING'], $like);

			unset($like['page']);

			

			$search_key = $this->input->get('username');

			if(isset($search_key) && $search_key){

				$this->data['search_key'] = $search_key;

			}else{

				$this->data['search_key'] = '';

			}



			$user_data = $this->userdata->grab_user_details(array(), array(), $like); 

			

			//pagination settings

			$config['base_url'] = base_url('admin/user-list');

			$config['total_rows'] = count($user_data);

			

			$pagination = $this->config->item('pagination');

			

			$pagination = array_merge($config, $pagination);



			$this->pagination->initialize($pagination);

			$this->data['page'] = ($this->input->get('page')) ? $this->input->get('page') : 0;		



			$this->data['pagination'] = $this->pagination->create_links();

			

			$user_paginated_data = $this->userdata->grab_user_details(array(), array(PAGINATION_PER_PAGE, $this->data['page']), $like);			

			

			$this->data['user_details'] = $user_paginated_data;

			

			$this->load->view('admin/user_list', $this->data);

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

		

		public function user_add(){				

			if($this->session->userdata('has_error')){

				$user_details = (object)$this->session->userdata;

				$this->data['user_details'] = $user_details;



				if($user_details->country_id){

					$states = $this->defaultdata->grabStateData(array("country_id" => $user_details->country_id));

					$this->data['states'] = $states;

				}

			}



			$country = $this->defaultdata->grabCountryData();

			$this->data['country'] = $country;

			

			$this->load->view('admin/user_add', $this->data);

		}

		

		public function add_user(){

			$post_data = $this->input->post();

			

			$this->load->library('form_validation');

			

			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');

			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');

			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[20]');

			$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|is_unique['.TABLE_USER.'.email]');

			$this->form_validation->set_rules('phone', 'Phone', 'trim|required|is_unique['.TABLE_USER.'.phone]');

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

				$this->session->set_userdata('useradd_notification', validation_errors());

				

				redirect($this->agent->referrer());

			}else{

				$post_data['date_added'] = time();

				$post_data['password'] = base64_encode(hash("sha256", $post_data['password'], True));



				$this->userdata->insert_user($post_data);

				

				$this->session->set_userdata('has_error', false);

				

				redirect(base_url('admin/user-list'));

			}

		}

		

		public function user_edit($user_id){

			if(!$this->session->userdata('has_error')){

				$cond['user_id'] = $user_id;

				$user_data = $this->userdata->grab_user_details($cond);

				

				$user_details = $user_data[0];				

			}else{

				$user_details = (object)$this->session->userdata;

			}

			$this->data['user_details'] = $user_details;



			if($user_details->country_id){

				$states = $this->defaultdata->grabStateData(array("country_id" => $user_details->country_id));

				$this->data['states'] = $states;

			}



			$country = $this->defaultdata->grabCountryData();

			$this->data['country'] = $country;

			

			$this->load->view('admin/user_edit', $this->data);

		}

		

		public function edit_user(){

			$post_data = $this->input->post();

			

			$this->load->library('form_validation');			

			

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



			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');

			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');

			if($post_data['password']){

				$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[20]');

			}

			$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email'.$is_unique);

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

				$this->session->set_userdata('useredit_notification', validation_errors());

				

				redirect($this->agent->referrer());

			}else{

				$cond['user_id'] = $post_data['user_id'];



				if($post_data['password']){

					$post_data['password'] = base64_encode(hash("sha256", $post_data['password'], True));

				}else{

					unset($post_data['password']);

				}

				unset($post_data['user_id']);

				unset($post_data['old_email']);

				unset($post_data['old_phone']);



				$post_data['date_modified'] = time();



				$this->userdata->update_user_details($cond, $post_data);

				

				redirect(base_url('admin/user-list'));

			}

		}

		

		public function user_delete($userid){			

			$cond['user_id'] = $userid;

			

			if($this->userdata->update_user_details($cond, array("status" => "N"))){

				redirect($this->agent->referrer());		

			}

		}

		

		public function logout()

		{

			$this->defaultdata->unsetLoginSession();

			redirect(base_url('admin'));

		}



		public function newsletter(){	

			$like = array();

			parse_str($_SERVER['QUERY_STRING'], $like);

			unset($like['page']);

			

			$search_key = $this->input->get('email');

			if(isset($search_key) && $search_key){

				$this->data['search_key'] = $search_key;

			}else{

				$this->data['search_key'] = '';

			}

			

			

			$list = $this->userdata->get_newsletter();

			

			//pagination settings

			$config['base_url'] = base_url('admin/newsletter');

			$config['total_rows'] = count($list);

			

			$pagination = $this->config->item('pagination');

			

			$pagination = array_merge($config, $pagination);



			$this->pagination->initialize($pagination);

			$this->data['page'] = ($this->input->get('page')) ? $this->input->get('page') : 0;		



			$this->data['pagination'] = $this->pagination->create_links();

			

			$list = $this->userdata->get_newsletter(array(), array(PAGINATION_PER_PAGE, $this->data['page']), $like);			

			

			$this->data['news'] = $list;

			

			$this->load->view('admin/newsletter', $this->data);

		}



		public function newsletter_edit($newsletter_id, $status){

			if($this->userdata->update_newsletter(array("newsletter_id" => $newsletter_id), array("status" => $status))){

				redirect(base_url('admin/newsletter'));

			}			

		}



		public function ads(){

			$ads_section = $this->adsdata->grab_ads_section();

			if(!empty($ads_section)){

				foreach ($ads_section as $value) {

					$value->ads = $this->adsdata->grab_ads(array("parent_id" => $value->ads_section_id));

				}

			}

			$this->data['ads_section'] = $ads_section;



			$this->load->view('admin/ads', $this->data);

		}



		public function update_ads(){

			$post_data = $this->input->post();



			if(isset($post_data['section'])){

				$status = 'Y';				

			}else{

				$status = 'N';

			}

			$this->adsdata->update_ads_section(array("ads_section_id" => $post_data['ads_section_id']), array("status" => $status));



			$uploaded_files = $_FILES;

			if(!empty($uploaded_files)){

				$this->load->library('image_lib');

				foreach ($uploaded_files as $key => $value) {

					if($value['error'] == 0){

						$ads = $this->adsdata->grab_ads(array("sort_order" => $key+1, "parent_id" => $post_data['ads_section_id']));



						// remove previous image

						if($ads[0]->image_path && file_exists(UPLOAD_RELATIVE_ADS_PATH.$ads[0]->image_path)){							

							if(unlink(UPLOAD_RELATIVE_ADS_PATH.$ads[0]->image_path)){

								$file_ext = strtolower(pathinfo($ads[0]->image_path, PATHINFO_EXTENSION));

								$file_name = basename($ads[0]->image_path, ".".$file_ext);



								if(file_exists(UPLOAD_RELATIVE_ADS_PATH.$file_name.'_thumb.'.$file_ext)){

									if(unlink(UPLOAD_RELATIVE_ADS_PATH.$file_name.'_thumb.'.$file_ext)){

										$this->adsdata->delete_ads(array("sort_order" => $key+1, "parent_id" => $post_data['ads_section_id']));

									}

								}

							}

						}



						$file_ext = strtolower(pathinfo($value['name'], PATHINFO_EXTENSION));

						$new_file_only_name = md5(time().'_'.$key);

						$new_file_name = $new_file_only_name.'.'.$file_ext;

						if(move_uploaded_file($value['tmp_name'], UPLOAD_RELATIVE_ADS_PATH.$new_file_name)){



							$this->defaultdata->create_thumb(UPLOAD_RELATIVE_ADS_PATH.$new_file_name, '_thumb', $post_data['width'], $post_data['height']);



							$this->adsdata->insert_ads(array("image_path" => $new_file_name, "parent_id" => $post_data['ads_section_id'], "sort_order" => $key+1));

						}

					}

				}

			}



			redirect(base_url('admin/ads'));

		}

	}

?>