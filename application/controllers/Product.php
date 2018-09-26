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

			$this->data['product'] = $product[0];
			$this->data['product_image'] = $product_image;
			$this->data['product_attr'] = $product_attr;

			$this->load->library('breadcrumb');
			$this->breadcrumb->add('Home', base_url());
			$this->breadcrumb->add($product[0]->name, base_url('changepassword')); 

			$this->data['breadcrumb'] = $this->breadcrumb->output();

			/*echo "<pre>";
			print_r($product_image);
			die();*/

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

			$this->data['product_list'] = $this->productdata->grab_product_list_all($entity, $start, $this->perPage);

			$products = $this->load->view('partials/products', $this->data, true);		

			echo $products;
		}
	}
?>