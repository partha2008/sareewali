<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Product extends CI_Controller {
		
		public $data = array();

		private $perPage = 6;
		
		public function __construct(){
			parent::__construct();

			$this->load->model('bannerdata');
			$this->load->model('entitydata');
			$this->load->model('userdata');
			$this->load->model('productdata');
			$this->load->model('adsdata');
			$this->load->model('reviewdata');

			$this->data = $this->defaultdata->getFrontendDefaultData();
		}

		public function product_details($slug){
			$product = $this->productdata->grab_product(array("slug" => $slug));
			$product_image = $this->productdata->grab_product_image(array("status" => "Y", "product_id" => $product[0]->product_id));
			$product_attr = $this->productdata->grab_product_attribute(array("product_id" => $product[0]->product_id));
			$random_entity_id = $this->entitydata->grab_random_product_entity(array("product_id" => $product[0]->product_id), array(1,1));
			$product_color = $this->productdata->grab_product_color_rel(array(TABLE_PRODUCT.".product_id" => $product[0]->product_id));
			$product_fabric = $this->productdata->grab_product_fabric(array("product_id" => $product[0]->product_id));

			$fabric_str = "";
			if(!empty($product_fabric)){
				foreach ($product_fabric as $key => $value) {
					$fabric_arr = $this->config->item("fabric");
					$fabric_str .= $fabric_arr[$value->fabric_id].", ";
				}
			}

			$product_occassion = $this->productdata->grab_product_occassion(array("product_id" => $product[0]->product_id));

			$occassion_str = "";
			if(!empty($product_occassion)){
				foreach ($product_occassion as $key => $value) {
					$occassion_arr = $this->config->item("occassion");
					$occassion_str .= $occassion_arr[$value->occassion_id].", ";
				}
			}

			$prd_color = '';
			if(!empty($product_color)){
				foreach ($product_color as $key => $value) {
					$prd_color .= ucfirst($value->name).',';
				}
			}

			$this->data['product'] = $product[0];
			$this->data['product_image'] = $product_image;
			$this->data['product_attr'] = $product_attr;
			$this->data['product_color'] = rtrim($prd_color, ',');
			$this->data['product_fabric'] = rtrim($fabric_str, ", ");
			$this->data['product_occassion'] = rtrim($occassion_str, ", ");

			$this->load->library('breadcrumb');
			$this->breadcrumb->add('Home', base_url());
			$parent_entity = $this->productdata->grab_parent_entity($random_entity_id[0]->entity_id);
			if(!empty($parent_entity)){
				foreach ($parent_entity as $key => $value) {
					$this->breadcrumb->add($value->name, base_url('product-list/'.$value->slug)); 
				}
			}
			$this->breadcrumb->add($product[0]->name, base_url());

			$best_selling_entity = $parent_entity[count($parent_entity)-1]->slug;

			$whr = "AND ".TABLE_PRODUCT_ENTITY.".product_id != ".$product[0]->product_id;
			$more_products = $this->productdata->grab_product_list_all($best_selling_entity, 0, 10, null, $whr);
			$this->data['more_products'] = $more_products;
			
			$whr .= " AND ".TABLE_PRODUCT_TAG.".tag_id = 1";
			$best_selling_products = $this->productdata->grab_product_list_all($best_selling_entity, 0, 10, null, $whr);

			$this->data['best_selling_products'] = $best_selling_products;

			$reviews = $this->reviewdata->grab_review(array("status" => "Y"));
			$this->data['reviews'] = $reviews;

			$state_data = $this->defaultdata->grabStateData(array("country_id" => 101));
			$this->data['state_data'] = $state_data;

			$this->data['breadcrumb'] = $this->breadcrumb->output();

			$this->load->view('product_details', $this->data); 
		}

		public function product_list($entity, $sub_entity = null){
			$this->load->library('breadcrumb');

			$entity_data = $this->entitydata->grab_entity(array("slug" => $entity));

			$this->breadcrumb->add('Home', base_url());
			$this->breadcrumb->add($entity_data[0]->name, base_url('product-list/'.$entity));
			if($sub_entity){
				$sub_entity_data = $this->entitydata->grab_entity(array("slug" => $sub_entity));
				$this->breadcrumb->add($sub_entity_data[0]->name, base_url('product-list/'.$entity));
				$product_list = $this->productdata->grab_product_list_all($sub_entity, 0, $this->perPage);

				$this->data['entity'] = $sub_entity_data[0]->name;
			}else{
				$product_list = $this->productdata->grab_product_list_all($entity, 0 , $this->perPage);
				$this->data['entity'] = $entity_data[0]->name;
			}	
			$this->data['product_list'] = $product_list;
			$this->data['products'] = $this->load->view('partials/products', $this->data, true);		
			$this->data['breadcrumb'] = $this->breadcrumb->output();

			$colors = $this->productdata->grab_color();
			$this->data['colors'] = $colors;

			$searchbar = $this->load->view('partials/searchbar', $this->data, true); 
			$this->data['searchbar'] = $searchbar;

			$this->load->view('product_list', $this->data); 
		}

		public function load_products(){
			$start = ceil($this->input->get("page") * $this->perPage);
			$entity = $this->input->get("view");
			$mode = $this->input->get("mode");
			$min_price = $this->input->get("min_price");
			$max_price = $this->input->get("max_price");
			$colors = $this->input->get("colors");
			$where = '';
			$order_by = '';

			if(isset($mode)){				
				if($mode == "new"){
					$order_by = TABLE_PRODUCT.".product_id DESC";
				}elseif($mode == "popular"){
					$where = "AND ".TABLE_PRODUCT_TAG.".tag_id = '2'";
					$order_by = TABLE_PRODUCT.".product_id DESC";
				}elseif($mode == "best"){
					$where = "AND ".TABLE_PRODUCT_TAG.".tag_id = '1'";
					$order_by = TABLE_PRODUCT.".product_id DESC";
				}elseif($mode == "low"){
					$order_by = TABLE_PRODUCT.".price ASC";
				}elseif($mode == "high"){
					$order_by = TABLE_PRODUCT.".price DESC";
				}
			}

			$where .= " AND ".TABLE_PRODUCT.".price BETWEEN ".$min_price." AND ".$max_price;
			if($colors){
				$where .= " AND ".TABLE_PRODUCT_COLOR.".color_id IN (".$colors.")";
			}

			$this->data['product_list'] = $this->productdata->grab_product_list_all($entity, $start, $this->perPage, $order_by, $where);

			$products = $this->load->view('partials/products', $this->data, true);		

			echo $products;
		}

		public function get_global_search(){
			$keyword = $this->input->get("query");

			$response = array();
			$response1 = array();

			$entity_data = $this->entitydata->grab_entity(array("status" => "Y", "parent_id !=" => "0"), array("name" => $keyword));
			
			if(!empty($entity_data)){
				foreach ($entity_data as $key => $value) {
					$response[$key]['value'] = $value->name;
					$response[$key]['data'] = base_url("product-list/".$value->slug);
				}

			}

			$product_data = $this->productdata->grab_product(array("status" => "Y"), array("name" => $keyword));

			if(!empty($product_data)){
				foreach ($product_data as $key => $value) {
					$response1[$key]['value'] = $value->name;
					$response1[$key]['data'] = base_url("product-details/".$value->slug);
				}

			}

			$res['suggestions'] = array_merge($response, $response1);

			echo json_encode($res);
		}

		public function add_review(){
			$post_data = $this->input->post();

			$this->load->library('form_validation');

			$this->form_validation->set_rules('reviewer', 'Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('phone', 'Phone', 'trim|required');
			$this->form_validation->set_rules('state_id', 'State', 'trim|required');
			$this->form_validation->set_rules('review', 'Review', 'trim|required');
			$this->form_validation->set_rules('rating', 'Rating', 'trim|required');
			$this->form_validation->set_rules('g-recaptcha-response', 'Rating', 'trim|required', array('required' => 'Captcha is Invalid'));

			if($this->form_validation->run() == FALSE)
			{					
				$response['success'] = false;
				$response['msg'] = validation_errors();
			}else{
				$post_data['date_added'] = time();
                unset($post_data['g-recaptcha-response']);
                
				if($this->reviewdata->insert_review($post_data)){			
					$response['success'] = true;
					$response['msg'] = "Thank you for your valuable comments. It will be published after admin approval.";
				}
			}

			echo json_encode($response);
		}
	}
?>