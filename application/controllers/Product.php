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

			$this->data = $this->defaultdata->getFrontendDefaultData();
		}

		public function product_details($slug){
			$product = $this->productdata->grab_product(array("slug" => $slug));
			$product_image = $this->productdata->grab_product_image(array("status" => "Y", "product_id" => $product[0]->product_id));
			$product_attr = $this->productdata->grab_product_attribute(array("product_id" => $product[0]->product_id));
			$random_entity_id = $this->entitydata->grab_random_product_entity(array("product_id" => $product[0]->product_id), array(1,1));

			$this->data['product'] = $product[0];
			$this->data['product_image'] = $product_image;
			$this->data['product_attr'] = $product_attr;

			$this->load->library('breadcrumb');
			$this->breadcrumb->add('Home', base_url());
			$parent_entity = $this->productdata->grab_parent_entity($random_entity_id[0]->entity_id);
			if(!empty($parent_entity)){
				foreach ($parent_entity as $key => $value) {
					$this->breadcrumb->add($value->name, base_url('product-list/'.$value->slug)); 
				}
			}
			$this->breadcrumb->add($product[0]->name, base_url()); 

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
	}
?>