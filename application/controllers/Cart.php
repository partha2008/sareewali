<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Cart extends CI_Controller {
		
		public $data = array();
		public $loggedin_method_arr = array('index', 'checkout');
		
		public function __construct(){
			parent::__construct();

			$this->load->model('bannerdata');
			$this->load->model('entitydata');
			$this->load->model('userdata');
			$this->load->model('productdata');
			$this->load->model('adsdata');
			$this->load->model('reviewdata');
			$this->load->model('cartdata');
			$this->load->model('coupondata');
			$this->load->model('orderdata');

			$this->data = $this->defaultdata->getFrontendDefaultData();

			if(in_array($this->data['tot_segments'][2], $this->loggedin_method_arr))
			{
				if($this->defaultdata->is_user_session_active() == 0)
				{
					redirect(base_url());
				}else{
					if($this->get_cart_sub_total() < 1){
						redirect(base_url());
					}
				}
			}
		}	

		public function index(){
			$this->load->library('breadcrumb');

			$this->breadcrumb->add('Home', base_url());
			$this->breadcrumb->add('Cart', base_url());		
			$this->data['breadcrumb'] = $this->breadcrumb->output();

			$cart_data = $this->cartdata->grab_cart(array("user_id" => $this->session->userdata('user_id'), "status" => "N"));

			if(!empty($cart_data)){
				$prd_image = $this->productdata->grab_product_image(array("product_id" => $cart_data[0]->product_id, "is_featured" => "Y"));

				$this->data['prd_image'] = $prd_image;
			}			
			$this->data['cart_data'] = $cart_data;
			$this->data['sub_total'] = $this->get_cart_sub_total();
			$this->data['discount'] = $this->get_discount_amount();
			$this->data['grand_total'] = $this->get_cart_grand_total();
			$this->data['price_chart'] = $this->load->view('partials/price_chart', $this->data, true);
			$this->data['basket'] = $this->load->view('partials/basket', $this->data, true);

			$this->load->view('cart', $this->data); 
		}

		public function success(){
			$orderId = $this->input->get('order_id');
			if(isset($orderId) && $orderId){
				$order_data = $this->orderdata->grab_order(array("orderid" => $orderId));
				if(!empty($order_data)){
					if($order_data[0]->status == 0){
						$site_info = $this->config->item('site_info');

					    $mg_api = $site_info['payment_api_key'];
						$curl_post_url = $site_info['payment_order_status_api'];			
						$merchantId = $site_info['merchantId'];

						$ch = curl_init($curl_post_url);

						curl_setopt($ch, CURLOPT_POSTFIELDS, array('orderId' => $orderId , 'merchantId' => $merchantId ));
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
					    curl_setopt($ch, CURLOPT_USERPWD, $mg_api);

						$result =  curl_exec($ch); 

						if(curl_error($ch))
						{
						    $this->data['payment_status'] = false;
							$this->data['msgTxt'] = curl_error($ch);
						}else{
							$response = json_decode($result, true);	
							if($response['status'] == "CHARGED"){
								$this->orderdata->update_order(array("orderid" => $orderId), array("status" => 1));

								$this->order_email($order_data[0]->transaction_id, false);

								$this->data['payment_status'] = true;
								$this->data['msgTxt'] = "Order made successfully";
								$this->data['transaction_id'] = $order_data[0]->transaction_id;
							}else{
								$this->data['payment_status'] = false;
								$this->data['msgTxt'] = "Payment not successful";
							}
						}	
						curl_close($ch);

						$this->load->view('success', $this->data); 
					}else{
						redirect(base_url());
					}
				}else{
					redirect(base_url());
				}
			}else{
				redirect(base_url());
			}
		}

		public function checkout(){	
			$this->load->library('breadcrumb');

			$this->breadcrumb->add('Home', base_url());
			$this->breadcrumb->add('Checkout', base_url());		
			$this->data['breadcrumb'] = $this->breadcrumb->output();

			$user = $this->userdata->grab_user_details(array("user_id" => $this->session->userdata('user_id')));
			$this->data['user'] = $user[0];

			$country = $this->defaultdata->grabCountryData();
			$this->data['country'] = $country;

			$this->data['sub_total'] = $this->get_cart_sub_total();
			$this->data['discount'] = $this->get_discount_amount();
			$this->data['grand_total'] = $this->get_cart_grand_total();
			$this->data['price_chart'] = $this->load->view('partials/price_chart', $this->data, true);

			$this->load->view('checkout', $this->data); 
		}

		public function add_to_cart(){
			$post_data = $this->input->post();

			$slug = $post_data['data'];

			$product_data = $this->productdata->grab_product(array("slug" => $slug));
			$cart_data = $this->cartdata->grab_cart(array("prd_slug" => $product_data[0]->slug, "user_id" => $this->session->userdata('user_id'), "status" => "N"));

			if(!empty($cart_data)){
				$this->cartdata->update_cart(array("prd_slug" => $product_data[0]->slug, "user_id" => $this->session->userdata('user_id'), "status" => "N"));

				$response['status'] = true;
				$response['data'] = $product_data[0]->name;
				$response['msg'] = "The item has been updated successfully.";
			}else{
				$insert_data = array(
					"prd_name" => $product_data[0]->name,
					"prd_slug" => $product_data[0]->slug,
					"prd_price" => $product_data[0]->price,
					"prd_discounted_price" => $product_data[0]->discounted_price,
					"prd_count" => 1,
					"user_id" => $this->session->userdata('user_id'),
					"product_id" => $product_data[0]->product_id
				);
				$this->cartdata->insert_cart($insert_data);

				$response['status'] = true;
				$response['data'] = $product_data[0]->name;
				$response['msg'] = "The item has been added successfully.";
			}

			$this->data['total_price'] = $this->get_cart_sub_total();
			$this->data['count'] = $this->get_cart_item_count();

			$response['html'] = $this->load->view('partials/cart', $this->data, true);

			echo json_encode($response);			
		}

		public function get_cart_sub_total(){
			$cart_data = $this->cartdata->grab_cart(array("user_id" => $this->session->userdata('user_id'), "status" => "N"));

			$sub_total = 0;
			if(!empty($cart_data)){
				foreach ($cart_data as $key => $value) {
					if((int)$value->prd_discounted_price > 0){
		              	$total_price = $value->prd_discounted_price*$value->prd_count;
		            }else{
		              	$total_price = $value->prd_price*$value->prd_count;
		            }
					$sub_total += $total_price;
				}
			}

			return $sub_total;
		}

		public function get_cart_grand_total(){
			$cart_data = $this->cartdata->grab_cart(array("user_id" => $this->session->userdata('user_id'), "status" => "N"));

			$sub_total = 0;
			if(!empty($cart_data)){
				foreach ($cart_data as $key => $value) {
					if((int)$value->prd_discounted_price > 0){
		              	$total_price = $value->prd_discounted_price*$value->prd_count;
		            }else{
		              	$total_price = $value->prd_price*$value->prd_count;
		            }
					$sub_total += $total_price;
				}
			}

			$result = $sub_total - $this->get_discount_amount();

			return number_format($result, 2);
		}

		public function get_cart_item_count(){
			$cart_data = $this->cartdata->grab_cart(array("user_id" => $this->session->userdata('user_id'), "status" => "N"));

			$count = 0;
			if(!empty($cart_data)){
				foreach ($cart_data as $key => $value) {
					$count ++;
				}
			}

			return $count;
		}

		public function update_cart(){
			$post_data = $this->input->post();

			$mode = $post_data['mode'];
			$cart_id = $post_data['cart_id'];

			if($mode == "increase"){
				$this->cartdata->update_cart(array("cart_id" => $cart_id));
			}elseif($mode == "decrease"){
				$this->cartdata->update_cart_decrease(array("cart_id" => $cart_id, "prd_count !=" => 1));
			}elseif($mode == "delete"){
				$this->cartdata->delete_cart(array("cart_id" => $cart_id));
			}

			$cart_data = $this->cartdata->grab_cart(array("user_id" => $this->session->userdata('user_id'), "status" => "N"));

			if(!empty($cart_data)){
				$prd_image = $this->productdata->grab_product_image(array("product_id" => $cart_data[0]->product_id, "is_featured" => "Y"));

				$this->data['prd_image'] = $prd_image;
			}
			$this->data['cart_data'] = $cart_data;
			$this->data['total_price'] = $this->data['sub_total'] = $this->get_cart_sub_total();
			$this->data['count'] = $this->get_cart_item_count();
			$this->data['sub_total'] = $this->get_cart_sub_total();
			$this->data['grand_total'] = $this->get_cart_grand_total();
			$this->data['discount'] = $this->get_discount_amount();
			$this->data['price_chart'] = $price_chart = $this->load->view('partials/price_chart', $this->data, true);
			
			$response['status'] = true;
			$response['msg'] = 'Your cart updated successfully.';
			$response['data'] = $this->load->view('partials/basket', $this->data, true);
			$response['html'] = $this->load->view('partials/cart', $this->data, true);

			echo json_encode($response);
		}

		public function get_discount_amount(){
			$coupon_discount = $this->session->userdata('active_coupon');
			
			$coupon_discount_amount = $this->get_cart_sub_total()*$coupon_discount/100;

			return $coupon_discount_amount;
		}

		public function get_discount(){
			$coupon = $this->input->post('coupon');

			$coupon_data = $this->coupondata->grab_coupon(array("code" => $coupon));

			if(!empty($coupon_data)){
				$this->session->set_userdata('active_coupon_code', $coupon);
				$this->session->set_userdata('active_coupon', $coupon_data[0]->discount);

				$this->data['sub_total'] = $this->get_cart_sub_total();
				$this->data['grand_total'] = $this->get_cart_grand_total();
				$this->data['discount'] = $this->get_discount_amount();
				$this->data['price_chart'] = $price_chart = $this->load->view('partials/price_chart', $this->data, true);

				$response["status"] = true;
				$response["data"] = $price_chart;
				$response["msgText"] = "The given Coupon exists";
			}else{
				$this->data['sub_total'] = $this->get_cart_sub_total();
				$this->data['grand_total'] = $this->get_cart_grand_total();
				$this->data['discount'] = $this->get_discount_amount();
				$this->data['price_chart'] = $price_chart = $this->load->view('partials/price_chart', $this->data, true);


				$response["status"] = false;
				$response["data"] = $price_chart;
				$response["msgText"] = "The given Coupon does not exists";
			}

			echo json_encode($response);
		}

		public function cancel_discount(){
			$this->session->unset_userdata('active_coupon');
			$this->session->unset_userdata('active_coupon_code');

			$this->data['sub_total'] = $this->get_cart_sub_total();
			$this->data['grand_total'] = $this->get_cart_grand_total();
			$this->data['discount'] = $this->get_discount_amount();
			$this->data['price_chart'] = $price_chart = $this->load->view('partials/price_chart', $this->data, true);

			$response["status"] = true;
			$response["data"] = $price_chart;
			$response["msgText"] = "The given Coupon cancelled";

			echo json_encode($response);
		}

		public function make_order(){
			$data = $this->input->post('data');			

			$response = array();
			parse_str($data, $response);
			
			$transaction_id = $this->defaultdata->generatedRandString(12);	
			if($response['payment_type'] == "cod"){
				$status = 1;
			}else{
				$status = 0;
			}
			$data = array(
				"transaction_id" => $transaction_id,
				"first_name" => $response['first_name'],
				"last_name" => $response['last_name'],
				"email" => $response['email'],
				"phone" => $response['phone'],
				"address1" => $response['address1'],
				"address2" => $response['address2'],
				"city" => $response['city'],
				"post_code" => $response['post_code'],
				"country_id" => $response['country_id'],
				"state_id" => $response['state_id'],
				"sub_total" => $response['sub_total'],
				"discount" => $response['discount'],
				"grand_total" => $response['grand_total'],
				"payment_type" => $response['payment_type'],
				"user_id" => $this->session->userdata('user_id'),
				"status" => $status,
				"date_added" => time()
			);
			$last_order_id = $this->orderdata->insert_order($data);

			if($last_order_id){
				$orderid = "SW-".sprintf('%03d', $last_order_id);
				$this->orderdata->update_order(array("order_id" => $last_order_id), array("orderid" => $orderid));

				$cart_data = $this->cartdata->grab_cart(array("user_id" => $this->session->userdata('user_id'), "status" => "N"));

				$data = array(
					"order_id" => $last_order_id,
					"order_data" => json_encode(serialize($cart_data))
				);
				$last_order_details_id = $this->orderdata->insert_order_details($data);

				$this->create_email_template($response);
				if($response['payment_type'] == "cod"){					
					$this->order_email($transaction_id);
				}else{
					$this->make_payment($response, $orderid, $transaction_id);
				}
			}else{
				$res['status'] = false;
				$res['msgTxt'] = "Order can not be made !";

				echo json_encode($res);
			}			
		}

		public function make_payment($data, $order_id, $transaction_id){
			$params = array();

		    $params['order_id'] = $order_id;
		    $params['amount'] = $this->defaultdata->parse_number($data['grand_total']);
		    $params['return_url'] = base_url("success");
		    $params['billing_address_first_name'] = $data['first_name'];
		    $params['billing_address_last_name'] = $data['last_name'];
			$params['customer_phone'] = $data['phone'];
			$params['customer_email'] = $data['email'];	

			$site_info = $this->config->item('site_info');
		    $mg_api = $site_info['payment_api_key'];
			$curl_post_url = $site_info['payment_order_api'];

			$ch = curl_init();

			curl_setopt ($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt ($ch, CURLOPT_MAXREDIRS, 3);
			curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, false);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt ($ch, CURLOPT_VERBOSE, 0);
			curl_setopt ($ch, CURLOPT_HEADER, 1);
			curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 10);
			curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt ($ch, CURLOPT_USERPWD, $mg_api . ":");
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt ($ch, CURLOPT_POST, true);
			curl_setopt ($ch, CURLOPT_HEADER, false);
			curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt ($ch, CURLOPT_URL, $curl_post_url);
			curl_setopt ($ch, CURLOPT_POSTFIELDS, $params);
			curl_setopt ($ch, CURLOPT_TIMEOUT, 0);
			
			$result = curl_exec($ch);

			if(curl_error($ch))
			{
			    $res['status'] = false;
				$res['msgTxt'] = curl_error($ch);
			}else{
				$response = json_decode($result, true);	
				if($response['status'] == "CREATED"){
					$weburl = $response['payment_links']['web'];

					$res['status'] = true;
					$res['msgTxt'] = "Order made successfully";
					$res['text'] = $transaction_id;
					$res['redirect'] = $weburl;
				}else{
					$res['status'] = false;
					$res['msgTxt'] = "Order can not be made !";
				}
			}	

			echo json_encode($res);

			curl_close($ch);
		}

		public function create_email_template($response){
			$general_settings = $this->data['general_settings'];
			$cart_data = $this->cartdata->grab_cart(array("user_id" => $this->session->userdata('user_id'), "status" => "N"));
			$user = $this->userdata->grab_user_details(array("user_id" => $this->session->userdata('user_id')));

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
			
			$this->data['name'] = $user[0]->first_name;
			$this->data['cart_data'] = $cart_data;
			$this->data['response'] = (object)$response;
			
			$message = $this->load->view('email_template/order', $this->data, true);

			$this->session->set_userdata('current_order_email', $message);
		}

		public function order_email($transaction_id, $return = true){
			$general_settings = $this->data['general_settings'];
			$admin_profile = $this->data['admin_profile'];

			$cart_data = $this->cartdata->grab_cart(array("user_id" => $this->session->userdata('user_id'), "status" => "N"));

			$user = $this->userdata->grab_user_details(array("user_id" => $this->session->userdata('user_id')));

			// empty cart table after successful transaction
			if(!empty($cart_data)){
				foreach ($cart_data as $key => $value) {
					$this->cartdata->delete_cart(array("cart_id" => $value->cart_id));
				}
			}
			$this->session->unset_userdata('active_coupon');
			$this->session->unset_userdata('active_coupon_code');		

			// send mail to user	
			$mail_config = array(
				"from" => $admin_profile->email,
				"to" => array($user[0]->email),
				"subject" => $general_settings->sitename.": New Order",
				"message" => $this->session->userdata('current_order_email')
			);
			
			$this->defaultdata->_send_mail($mail_config);

			$this->session->unset_userdata('current_order_email');

			if($return){
				$res['status'] = true;
				$res['msgTxt'] = "Order made successfully";
				$res['text'] = $transaction_id;

				echo json_encode($res);
			}
		}
	}
?>