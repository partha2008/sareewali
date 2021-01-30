<?php

	defined('BASEPATH') OR exit('No direct script access allowed');



	class Cart extends CI_Controller {

		

		public $data = array();

		public $loggedin_method_arr = array('index', 'checkout', 'checkout_request');

		

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
					
					if(!$this->session->userdata('guest')){
						redirect(base_url());
					}

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


			if($this->defaultdata->is_user_session_active() == 0){
				$cart_data = $this->cartdata->grab_cart_image_list(array(TABLE_CART.".user_id" => $this->session->userdata('guest'), TABLE_CART.".status" => "N", TABLE_PRODUCT_IMAGES.".is_featured" => "Y"));
			
			}else{
				$cart_data = $this->cartdata->grab_cart_image_list(array(TABLE_CART.".user_id" => $this->session->userdata('user_id'), TABLE_CART.".status" => "N", TABLE_PRODUCT_IMAGES.".is_featured" => "Y"));
			}
			



			$this->data['cart_data'] = $cart_data;

			$this->data['sub_total'] = $this->get_cart_sub_total();

			$this->data['discount'] = $this->get_discount_amount();

			$this->data['grand_total'] = $this->get_cart_grand_total();

			$this->data['price_chart'] = $this->load->view('partials/price_chart', $this->data, true);

			$this->data['basket'] = $this->load->view('partials/basket', $this->data, true);



			$this->load->view('cart', $this->data); 

		}

		public function add_to_cart(){

			$post_data = $this->input->post();



			$slug = $post_data['data'];
			$prd_size = $post_data['prd_size'];



			$product_data = $this->productdata->grab_product(array("slug" => $slug));

			if($this->session->userdata('user_id')){
				$cart_data = $this->cartdata->grab_cart(array("prd_slug" => $product_data[0]->slug, "user_id" => $this->session->userdata('user_id'), "status" => "N"));
			}else{
				if($this->session->userdata('guest')){
					$cart_data = $this->cartdata->grab_cart(array("prd_slug" => $product_data[0]->slug, "user_id" => $this->session->userdata('guest'), "status" => "N"));
				}
			}

			if(!empty($cart_data)){
				if($this->session->userdata('user_id')){
					$this->cartdata->update_cart(array("prd_slug" => $product_data[0]->slug, "user_id" => $this->session->userdata('user_id'), "status" => "N"));
				}else{
					if($this->session->userdata('guest')){
						$this->cartdata->update_cart(array("prd_slug" => $product_data[0]->slug, "user_id" => $this->session->userdata('guest'), "status" => "N"));
					}
				}
				



				$response['status'] = true;

				$response['data'] = $product_data[0]->name;

				$response['msg'] = "The item has been updated successfully.";

			}else{

				if($this->defaultdata->is_user_session_active()){
					$user_id = $this->session->userdata('user_id');
				}else{
					if(!$this->session->userdata('guest')){						
						$this->session->set_userdata('guest', $this->defaultdata->getSha256Base64Hash(12));
					}
					$user_id = $this->session->userdata('guest');
				}

				$insert_data = array(

					"prd_name" => $product_data[0]->name,
					"prd_slug" => $product_data[0]->slug,
					"prd_size" => $prd_size,
					"prd_price" => $product_data[0]->price,
					"prd_discounted_price" => $product_data[0]->discounted_price,
					"prd_count" => 1,
					"user_id" => $user_id,
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
			if($this->defaultdata->is_user_session_active()){
				$cart_data = $this->cartdata->grab_cart(array("user_id" => $this->session->userdata('user_id'), "status" => "N"));
			}else{
				$cart_data = $this->cartdata->grab_cart(array("user_id" => $this->session->userdata('guest'), "status" => "N"));
			}



			$sub_total = 0;

			if(!empty($cart_data)){

				foreach ($cart_data as $key => $value) {

					if($value->prd_discounted_price > 0){

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
			if($this->defaultdata->is_user_session_active()){
				$cart_data = $this->cartdata->grab_cart(array("user_id" => $this->session->userdata('user_id'), "status" => "N"));
			}else{
				$cart_data = $this->cartdata->grab_cart(array("user_id" => $this->session->userdata('guest'), "status" => "N"));
			}



			$sub_total = 0;

			if(!empty($cart_data)){

				foreach ($cart_data as $key => $value) {

					if($value->prd_discounted_price > 0){

		              	$total_price = $value->prd_discounted_price*$value->prd_count;

		            }else{

		              	$total_price = $value->prd_price*$value->prd_count;

		            }

					$sub_total += $total_price;

				}

			}



			$result = $sub_total - $this->get_discount_amount();



			return $result;

		}



		public function get_cart_item_count(){
			if($this->defaultdata->is_user_session_active()){
				$cart_data = $this->cartdata->grab_cart(array("user_id" => $this->session->userdata('user_id'), "status" => "N"));
			}else{
				$cart_data = $this->cartdata->grab_cart(array("user_id" => $this->session->userdata('guest'), "status" => "N"));
			}



			$count = 0;

			if(!empty($cart_data)){

				foreach ($cart_data as $key => $value) {

					$count ++;

				}

			}



			return $count;

		}

		public function success(){			

			$encResponse = $this->input->post('encResp');



			if($encResponse){

				$workingKey = $this->config->item('site_info')['ccavenue_working_key'];

				$rcvdString = $this->defaultdata->decrypt($encResponse,$workingKey);		

				$order_status = "";

				$decryptValues = explode('&', $rcvdString);

				$dataSize = sizeof($decryptValues);



				for($i = 0; $i < $dataSize; $i++) 

				{

					$information = explode('=', $decryptValues[$i]);

					$arr[] = $information[1];	

				}



				$order_id = $arr[0];

	            $order_trans_id = $arr[1];

	            $order_status = $arr[3];



	            if(isset($order_id) && $order_id){

	            	$order_data = $this->orderdata->grab_order(array("orderid" => $order_id));



	            	if(!empty($order_data)){

	            		if($order_data[0]->status == 0){

	            			if($order_status == "Success"){

								$this->orderdata->update_order(array("orderid" => $order_id), array("status" => 1));



								$this->order_email($order_data[0]->transaction_id, false);



								$this->data['payment_status'] = true;

								$this->data['msgTxt'] = "Order made successfully";

								$this->data['transaction_id'] = $order_data[0]->transaction_id;

							}else{

								$this->data['payment_status'] = false;

								$this->data['msgTxt'] = "Payment not successful";

							}



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

			}else{

            	redirect(base_url());

            }

		}


		public function checkout(){	

			$this->load->library('breadcrumb');



			$this->breadcrumb->add('Home', base_url());

			$this->breadcrumb->add('Checkout', base_url());		

			$this->data['breadcrumb'] = $this->breadcrumb->output();

			if($this->session->userdata('user_id')){
				$user = $this->userdata->grab_user_details(array("user_id" => $this->session->userdata('user_id')));

				$this->data['user'] = $user[0];
			}else{
				$this->data['user'] = new stdClass();
			}

			



			$country = $this->defaultdata->grabCountryData();

			$this->data['country'] = $country;



			$this->data['sub_total'] = $this->get_cart_sub_total();

			$this->data['discount'] = $this->get_discount_amount();

			$this->data['grand_total'] = $this->get_cart_grand_total();

			$this->data['price_chart'] = $this->load->view('partials/price_chart', $this->data, true);



			$this->load->view('checkout', $this->data); 

		}

		public function before_place_order(){
			$status = true;
			$msg = '';
			if($this->session->userdata('user_id')){
				$cart_data = $this->cartdata->grab_cart(array("user_id" => $this->session->userdata('user_id'), "status" => "N"));
			}else{
				$cart_data = $this->cartdata->grab_cart(array("user_id" => $this->session->userdata('guest'), "status" => "N"));
			}

			if(!empty($cart_data)){

				foreach ($cart_data as $key => $value) {

					$product_data = $this->productdata->grab_product(array("slug" => $value->prd_slug));

					if($product_data[0]->mode_qnty == "2"){
						$prd_size_data = $this->productdata->grab_product_size(array("product_id" => $product_data[0]->product_id, "size" => $value->prd_size));

						if($product_data[0]->out_of_stock == "Y" || $prd_size_data[0]->quantity == 0){
							$this->cartdata->delete_cart(array("cart_id" => $value->cart_id));

							$msg = "The item(s) in the cart are out of stock";
							$status = false;
						}else{
							if($value->prd_count > $prd_size_data[0]->quantity){
								$this->cartdata->delete_cart(array("cart_id" => $value->cart_id));

								$msg = "The given quantity of item(s) not allowed in the cart";
								$status = false;
							}
						}
					}else{
						if($product_data[0]->out_of_stock == "Y" || $product_data[0]->quantity == 0){
							$this->cartdata->delete_cart(array("cart_id" => $value->cart_id));

							$msg = "The item(s) in the cart are out of stock";
							$status = false;
						}else{
							if($value->prd_count > $product_data[0]->quantity){
								$this->cartdata->delete_cart(array("cart_id" => $value->cart_id));

								$msg = "The given quantity of item(s) not allowed in the cart";
								$status = false;
							}
						}
					}
					
				}

			}

			$response["status"] = $status;
			$response["msg"] = $msg;

			echo json_encode($response);
		}

		public function update_cart(){
			$cart_updated = true;
			$post_data = $this->input->post();



			$mode = $post_data['mode'];

			$cart_id = $post_data['cart_id'];		


			if($mode == "increase"){
				$prd_slug = $post_data['prd_slug'];
				$product_data = $this->productdata->grab_product(array("slug" => $prd_slug));
				
				$cart_data = $this->cartdata->grab_cart(array("cart_id" => $cart_id));
				
				if($product_data[0]->out_of_stock === "Y"){
					$this->cartdata->delete_cart(array("cart_id" => $cart_id));

					$cart_updated = false;
					$response['out_of_stock'] = true;
					$response['msg'] = 'The product is out of stock';
				}else{
					if($product_data[0]->mode_qnty == "2"){
						$prd_size_data = $this->productdata->grab_product_size(array("product_id" => $product_data[0]->product_id, "size" => $cart_data[0]->prd_size));

						if($cart_data[0]->prd_count < $prd_size_data[0]->quantity){
							$this->cartdata->update_cart(array("cart_id" => $cart_id));
						}else{
							$cart_updated = false;
							$response['out_of_stock'] = false;
							$response['msg'] = 'We are sorry. Only '.$cart_data[0]->prd_count.' unit(s) allowed in each order';
						}
					}else{
						if($cart_data[0]->prd_count < $product_data[0]->quantity){
							$this->cartdata->update_cart(array("cart_id" => $cart_id));
						}else{
							$cart_updated = false;
							$response['out_of_stock'] = false;
							$response['msg'] = 'We are sorry. Only '.$cart_data[0]->prd_count.' unit(s) allowed in each order';
						}
					}					
				}
			}elseif($mode == "decrease"){

				$this->cartdata->update_cart_decrease(array("cart_id" => $cart_id, "prd_count !=" => 1));

			}elseif($mode == "delete"){

				$this->cartdata->delete_cart(array("cart_id" => $cart_id));

			}

			if($cart_updated){
				if($this->defaultdata->is_user_session_active() == 0){
					$cart_data = $this->cartdata->grab_cart_image_list(array(TABLE_CART.".user_id" => $this->session->userdata('guest'), TABLE_CART.".status" => "N", TABLE_PRODUCT_IMAGES.".is_featured" => "Y"));
				}else{
					$cart_data = $this->cartdata->grab_cart_image_list(array(TABLE_CART.".user_id" => $this->session->userdata('user_id'), TABLE_CART.".status" => "N", TABLE_PRODUCT_IMAGES.".is_featured" => "Y"));
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
			}else{
				$response['status'] = false;
			}

			



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

			if($this->session->userdata('user_id')){
				$user_id = $this->session->userdata('user_id');
			}else{
				$user_id = $this->session->userdata('guest');
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

				"user_id" => $user_id,

				"status" => $status,

				"date_added" => time()

			);

			$last_order_id = $this->orderdata->insert_order($data);



			if($last_order_id){

				$orderid = "SW-".sprintf('%03d', $last_order_id);

				$this->orderdata->update_order(array("order_id" => $last_order_id), array("orderid" => $orderid));


				if($this->session->userdata('user_id')){
					$cart_data = $this->cartdata->grab_cart(array("user_id" => $this->session->userdata('user_id'), "status" => "N"));
				}else{
					$cart_data = $this->cartdata->grab_cart(array("user_id" => $this->session->userdata('guest'), "status" => "N"));
				}



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

			$site_info = $this->config->item('site_info');

			if($data['address2']){

				$address = $data['address1'].', '.$data['address2'];

			}else{

				$address = $data['address1'];

			}



			$params = array();

			$country = $this->defaultdata->grabCountryData(array("country_id" => $data['country_id']));

			$state = $this->defaultdata->grabStateData(array("state_id" => $data['state_id']));



		    $params['checkout']['tid'] = time();

		    $params['checkout']['merchant_id'] = $site_info['ccavenue_merchant_id'];

		    $params['checkout']['order_id'] = $order_id;

		    $params['checkout']['currency'] = 'INR';

		    $params['checkout']['redirect_url'] = base_url("success");

		    $params['checkout']['cancel_url'] = base_url("success");

		    $params['checkout']['billing_name'] = $data['first_name'].' '.$data['last_name'];

		    $params['checkout']['billing_email'] = $data['email'];

		    $params['checkout']['billing_tel'] = $data['phone'];

		    $params['checkout']['billing_address'] = $address;

		    $params['checkout']['billing_country'] = $country[0]->name;

		    $params['checkout']['billing_state'] = $state[0]->name;

		    $params['checkout']['billing_city'] = $data['city'];

		    $params['checkout']['billing_zip'] = $data['post_code'];

		    $params['checkout']['amount'] = $this->defaultdata->parse_number($data['grand_total']);



		    $this->session->set_userdata($params);



		    $res['status'] = true;

			$res['redirect'] = base_url('checkout-request');



			echo json_encode($res);

		}



		public function checkout_request(){

			$this->load->view('checkout_request', $this->data);

		}


		public function create_email_template($response){

			$general_settings = $this->data['general_settings'];

			if($this->session->userdata('user_id')){
				$cart_data = $this->cartdata->grab_cart(array("user_id" => $this->session->userdata('user_id'), "status" => "N"));
			}else{
				$cart_data = $this->cartdata->grab_cart(array("user_id" => $this->session->userdata('guest'), "status" => "N"));
			}

			if($this->session->userdata('user_id')){
				$user = $this->userdata->grab_user_details(array("user_id" => $this->session->userdata('user_id')));

				$user_fn = $user[0]->first_name;
			}else{
				$order_data = $this->orderdata->grab_order(array("user_id" => $this->session->userdata('guest')));

				$user_fn = $order_data[0]->first_name;
			}

			



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

			

			$this->data['name'] = $user_fn;

			$this->data['cart_data'] = $cart_data;

			$this->data['response'] = (object)$response;

			

			$message = $this->load->view('email_template/order', $this->data, true);



			$this->session->set_userdata('current_order_email', $message);

		}



		public function order_email($transaction_id, $return = true){

			$general_settings = $this->data['general_settings'];

			$admin_profile = $this->data['admin_profile'];

			if($this->session->userdata('user_id')){
				$cart_data = $this->cartdata->grab_cart(array("user_id" => $this->session->userdata('user_id'), "status" => "N"));
			}else{
				$cart_data = $this->cartdata->grab_cart(array("user_id" => $this->session->userdata('guest'), "status" => "N"));
			}

			
			if($this->session->userdata('user_id')){
				$user = $this->userdata->grab_user_details(array("user_id" => $this->session->userdata('user_id')));
				$user_email = $user[0]->email;
			}else{
				$order_data = $this->orderdata->grab_order(array("user_id" => $this->session->userdata('guest')));
				$user_email = $order_data[0]->email;
			}


			


			// empty cart table after successful transaction

			if(!empty($cart_data)){

				foreach ($cart_data as $key => $value) {					
					$product_data = $this->productdata->grab_product(array("product_id" => $value->product_id));

					// update product count
					if($product_data[0]->mode_qnty == "2"){
						$prd_size_data = $this->productdata->grab_product_size(array("product_id" => $value->product_id, "size" => $value->prd_size));

						$this->db->query("UPDATE ".TABLE_PRODUCT_SIZE." SET quantity=quantity-$value->prd_count WHERE product_id = " . $value->product_id . " AND size = ". $value->prd_size );
					}else{
						$this->db->query("UPDATE ".TABLE_PRODUCT." SET quantity=quantity-$value->prd_count WHERE product_id = " . $value->product_id );
					}					

					$this->cartdata->delete_cart(array("cart_id" => $value->cart_id));

				}

			}

			$this->session->unset_userdata('active_coupon');

			$this->session->unset_userdata('active_coupon_code');		



			// send mail to user	

			$mail_config = array(

				"from" => $admin_profile->email,

				"to" => array($user_email),

				"subject" => $general_settings->sitename.": New Order",

				"message" => $this->session->userdata('current_order_email')

			);

			

			$this->defaultdata->_send_mail($mail_config);



			$this->session->unset_userdata('current_order_email');
			$this->session->unset_userdata('guest');



			if($return){

				$res['status'] = true;

				$res['msgTxt'] = "Order made successfully";

				$res['text'] = $transaction_id;



				echo json_encode($res);

			}

		}

	}

?>