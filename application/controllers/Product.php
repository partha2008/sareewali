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
			$this->load->model('cartdata');

			$this->data = $this->defaultdata->getFrontendDefaultData();
		}

		public function product_details($slug){
			$this->load->library('breadcrumb');
			$this->breadcrumb->add('Home', base_url());

			$product = $this->productdata->grab_product(array("slug" => $slug));
			$product_image = $this->productdata->grab_product_image(array("status" => "Y", "product_id" => $product[0]->product_id));
			$product_attr = $this->productdata->grab_product_attribute(array("product_id" => $product[0]->product_id));
			$random_entity_id = $this->entitydata->grab_random_product_entity(array("product_id" => $product[0]->product_id), array(1,1));
			
			$prd_ent = $this->productdata->grab_product_entity_attribute($product[0]->product_id);		
			if(!empty($prd_ent)){
				foreach ($prd_ent as $key => $value) {
					$sql = "SELECT a.name FROM ".TABLE_PREFIX.$value['name']." a INNER JOIN ".TABLE_PREFIX.'product_'.$value['name']." b ON a.".$value['name']."_id = b. ".$value['name']."_id WHERE b.product_id='".$product[0]->product_id."' ";	
					$query = $this->db->query($sql);					
					$result = $query->result_array();

					$str = '';
					if(!empty($result)){
						foreach ($result as $k => $v) {
							$str .= $v['name'].', ';
						}
					}

					$prd_ent[$key]['data'] = rtrim($str, ", ");
				}
			}

			$this->data['prd_ent'] = $prd_ent;
			$this->data['product'] = $product[0];
			$this->data['product_image'] = $product_image;
			$this->data['product_attr'] = $product_attr;

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

			$reviews = $this->reviewdata->grab_review_user_list(array(TABLE_REVIEW.".status" => "Y", TABLE_REVIEW.".product_id" => $product[0]->product_id));
			$this->data['reviews'] = $reviews;

			$state_data = $this->defaultdata->grabStateData(array("country_id" => 101));
			$this->data['state_data'] = $state_data;

			$this->data['review_modal'] = $this->load->view('partials/review_modal', $this->data, true);

			$this->data['breadcrumb'] = $this->breadcrumb->output();

			$prd_sizes = $this->productdata->grab_product_size(array("product_id" => $product[0]->product_id));

			$this->data['prd_sizes'] = $prd_sizes;

			$prd_entity = $this->productdata->grab_selected_product_entity(array("product_id" => $product[0]->product_id));
			if(!empty($prd_entity)){
				foreach ($prd_entity as $key => $value) {
					$prd_entity_arr[] = $value->slug;
				}
			}
			if(in_array('sarees', $prd_entity_arr)){
				$this->data['how_to_measure'] = $this->load->view('partials/how_to_measure', null, true);
			}else{
				$this->data['how_to_measure'] = $this->load->view('partials/how_to_measure_kurti', null, true);
			}
			
			$this->data['size_chart'] = $this->load->view('partials/size_chart', null, true);			
			
			$this->data['more_collections'] = $this->load->view('partials/more_collections', $this->data, true);
			$this->data['best_selling_products'] = $this->load->view('partials/best_selling_products', $this->data, true);
			$this->data['product_details_tab'] = $this->load->view('partials/product_details_tab', $this->data, true);

			$this->load->view('product_details', $this->data); 
		}

		public function product_list($entity, $sub_entity = null){
			$this->load->library('breadcrumb');

			$entity_data = $this->entitydata->grab_entity(array("slug" => $entity));

			$this->breadcrumb->add('Home', base_url());
			$this->breadcrumb->add($entity_data[0]->name, base_url('product-list/'.$entity));

			$order_by = TABLE_PRODUCT.".date_added DESC";

			if($sub_entity){
				$sub_entity_data = $this->entitydata->grab_entity(array("slug" => $sub_entity));
				$this->breadcrumb->add($sub_entity_data[0]->name, base_url('product-list/'.$entity));
				$product_list = $this->productdata->grab_product_list_all($sub_entity, 0, $this->perPage, $order_by);

				$this->data['entity'] = $sub_entity_data[0]->name;
			}else{
				$product_list = $this->productdata->grab_product_list_all($entity, 0 , $this->perPage, $order_by);
				$this->data['entity'] = $entity_data[0]->name;
			}	

			$ent_attr = $this->entitydata->grab_entity_attribute($entity_data[0]->entity_id);
			if(!empty($ent_attr)){
				foreach ($ent_attr as $key => $value) {
					$sql = "SELECT  DISTINCT a.".$value->name."_id, a.name FROM ".TABLE_PREFIX.$value->name." as a INNER JOIN ".TABLE_PREFIX.'product_'.$value->name." as b ON a.".$value->name."_id = b.".$value->name."_id INNER JOIN ".TABLE_PRODUCT_ENTITY." as c ON b.product_id=c.product_id WHERE c.entity_id='".$entity_data[0]->entity_id."' ";	
					$query = $this->db->query($sql);
					
					$result = $query->result();
					$ent_attr[$key]->ent_data = $result;
				}
			}

			$this->data['ent_attr'] = $ent_attr;
			$this->data['product_list'] = $product_list;
			$this->data['products'] = $this->load->view('partials/products', $this->data, true);		
			$this->data['breadcrumb'] = $this->breadcrumb->output();

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
			$attrs = json_decode($this->input->get("attrs"), true);
			$where = '';
			$join = '';
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
			}else{
				$order_by = TABLE_PRODUCT.".date_added DESC";
			}

			$where .= " AND ".TABLE_PRODUCT.".price BETWEEN ".$min_price." AND ".$max_price;
			if(!empty($attrs)){
				foreach ($attrs as $key => $value) {
					if(!empty($attrs[$key])){
						$str = '';
						foreach ($attrs[$key] as $k => $v) {
							$str .= $v['value'].',';
						}
					}
					$where .= " AND ".TABLE_PREFIX.'product_'.$key.".".$key."_id IN (".rtrim($str, ",").")";
					$join .= " LEFT JOIN ".TABLE_PREFIX.'product_'.$key." ON ".TABLE_PRODUCT.".product_id = ".TABLE_PREFIX.'product_'.$key.".product_id";
				}
			}

			$this->data['product_list'] = $this->productdata->grab_product_list_all($entity, $start, $this->perPage, $order_by, $where, $join);

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

		public function check_availability(){
			$post_data = $this->input->post();
			$admin_profile = $this->data['admin_profile'];

			$pin_data = $this->productdata->grab_pincode(array("pincode" => $post_data['pincode']));

			if(!empty($pin_data)){
				$response['status'] = true;
				$response['msg'] = "The given Pincode is serviceable";
			}else{
				$response['status'] = false;
				$response['msg'] = "Please contact to ".$admin_profile->email." / ".$admin_profile->contact_no." for shipment";
			}

			echo json_encode($response);
		}

		public function notify(){

			$post_data = $this->input->post();

			if($this->productdata->insert_notify($post_data)){
				$response['status'] = true;
				$response['msg'] = 'Thanks for subscribing with us.';
			}else{
				$response['status'] = false;
				$response['msg'] = 'Something went wrong!';
			}

			echo json_encode($response);

		}
	}
?>