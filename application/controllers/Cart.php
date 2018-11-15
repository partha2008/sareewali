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
			$this->data['basket'] = $this->load->view('partials/basket', $this->data, true);

			$this->load->view('cart', $this->data); 
		}

		public function checkout(){
			$this->load->library('breadcrumb');

			$this->breadcrumb->add('Home', base_url());
			$this->breadcrumb->add('Checkout', base_url());		
			$this->data['breadcrumb'] = $this->breadcrumb->output();

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

			return number_format($sub_total, 2);
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
			
			$response['status'] = true;
			$response['msg'] = 'Your cart updated successfully.';
			$response['data'] = $this->load->view('partials/basket', $this->data, true);
			$response['html'] = $this->load->view('partials/cart', $this->data, true);

			echo json_encode($response);
		}
	}
?>