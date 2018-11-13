<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Cart extends CI_Controller {
		
		public $data = array();
		
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
		}	

		public function add_to_cart(){
			$post_data = $this->input->post();

			$slug = $post_data['data'];

			$product_data = $this->productdata->grab_product(array("slug" => $slug));
			$cart_data = $this->cartdata->grab_cart(array("prd_name" => $product_data[0]->name, "user_id" => $this->session->userdata('user_id'), "status" => "N"));

			if(!empty($cart_data)){
				$this->cartdata->update_cart(array("prd_name" => $product_data[0]->name, "user_id" => $this->session->userdata('user_id'), "status" => "N"));

				$response['status'] = true;
				$response['data'] = $product_data[0]->name;
				$response['msg'] = "The item has been updated successfully.";
			}else{
				$insert_data = array(
					"prd_name" => $product_data[0]->name,
					"prd_price" => $product_data[0]->price,
					"prd_discounted_price" => $product_data[0]->discounted_price,
					"prd_count" => 1,
					"user_id" => $this->session->userdata('user_id')
				);
				$this->cartdata->insert_cart($insert_data);

				$response['status'] = true;
				$response['data'] = $product_data[0]->name;
				$response['msg'] = "The item has been added successfully.";
			}

			$cart_data = $this->cartdata->grab_cart(array("user_id" => $this->session->userdata('user_id'), "status" => "N"));

			$count = 0;
			$total_price = 0;
			if(!empty($cart_data)){
				foreach ($cart_data as $key => $value) {
					if((int)$value->prd_discounted_price > 0){
						$total_price = $total_price + $value->prd_discounted_price*$value->prd_count;
					}else{
						$total_price = $total_price + $value->prd_price*$value->prd_count;
					}
					
					$count++;
				}
			}

			$this->data['total_price'] = number_format($total_price, 2);
			$this->data['count'] = $count;

			$response['html'] = $this->load->view('partials/cart', $this->data, true);

			echo json_encode($response);			
		}	
	}
?>