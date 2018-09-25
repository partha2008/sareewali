	<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Product extends CI_Controller{
		
		public $data = array();
		public $loggedin_method_arr = array('product-list', 'product-add', 'product-edit', 'product-customise');
		
		public function __construct(){
			parent::__construct();
			
			$this->load->model('productdata');
			$this->load->model('entitydata');

			$this->data = $this->defaultdata->getBackendDefaultData();
			
			if(in_array($this->data['tot_segments'][1], $this->loggedin_method_arr))
			{
				if($this->defaultdata->is_session_active() == 0)
				{
					redirect(base_url());
				}
			}
		}

		public function get_products(){
			$offset = $this->input->get('start');
			$limit = $this->input->get('length');
			$search_val = $this->input->get('search')['value'];

			$product_data = $this->productdata->grab_product_entity(array(), $search_val, array());

			$paginated_data = $this->productdata->grab_product_entity(array(), $search_val, array($limit, $offset));

			$record_total = count($product_data);
			$record_filtered = count($product_data);
			$draw =  $this->input->get('draw');
			
			$response['draw'] = $draw;
			$response['recordsTotal'] = $record_total;
			$response['recordsFiltered'] = $record_filtered;
			$response['data'] = $paginated_data;
			
			echo json_encode($response);
		}

		public function product_list(){
			$this->load->view('admin/product_list', $this->data); 
		}
		
		public function product_add(){
			if($this->session->userdata('has_error')){
				$sess_data = $this->session->userdata;
				$this->data['product_details'] = (object)$sess_data;
			}
			$cat_data = $this->entitydata->grab_entity(array("status" => 'Y', "parent_id !=" => "0"), array(), array());
			$this->data['cat_list'] = $cat_data;

			$unit = $this->config->item('unit');
			$this->data['unit'] = $unit;
			
			$this->load->view('admin/product_add', $this->data); 
		}
		
		public function add_product(){
			$post_data = $this->input->post();

			echo "<pre>";
			print_r($post_data);
			die();

			$attrname = $post_data['attrname'];
			$attrval = $post_data['attrval'];
			$attrunit = $post_data['attrunit'];
			$prd_entity = $post_data['entity_id'];

			$this->load->library('form_validation');
			
			if(empty($prd_entity)){
				$this->form_validation->set_rules('entity_id[]', 'Entity', 'trim|required');
			}
			$this->form_validation->set_rules('name', 'Name', 'trim|required|is_unique['.TABLE_PRODUCT.'.name]');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');
			$this->form_validation->set_rules('price', 'Price', 'trim|required');
			$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required');
			$this->form_validation->set_rules('sku', 'SKU', 'trim|required|is_unique['.TABLE_PRODUCT.'.sku]');
			$this->form_validation->set_rules('upload_image', 'Upload Images', 'required');
			
			$this->session->unset_userdata($post_data);
			if($this->form_validation->run() == FALSE)
			{	
				$this->session->set_userdata($post_data);
				$this->session->set_userdata('has_error', true);
				$this->session->set_userdata('productadd_notification', validation_errors());
				
				redirect($this->agent->referrer());
			}else{
				unset($post_data['attrname']);
				unset($post_data['attrval']);
				unset($post_data['attrunit']);
				unset($post_data['upload_image']);
				unset($post_data['entity_id']);

				// product
				$post_data['slug'] = $this->defaultdata->slugify($post_data['name']);
				$post_data['date_added'] = time();

				$prd_last_id = $this->productdata->insert_product($post_data);

				// product entity
				if(!empty($prd_entity)){
					foreach ($prd_entity as $entity) {
						$data = array();
						$data['product_id'] = $prd_last_id;
						$data['entity_id'] = $entity;
						
						$this->productdata->insert_product_entity_rel($data);
					}
				}

				// attribute			
				if(!empty($attrname)){
					foreach ($attrname as $key => $value) {
						if($value){
							$data = array("name" => strtolower(trim($value)));
							$record = $this->productdata->grab_attribute($data);
							if(empty($record)){
								$attr_last_id = $this->productdata->insert_attribute($data);
							}else{
								$attr_last_id = $record[0]->attribute_id;
							}

							$data = array("product_id" => $prd_last_id, "attribute_id" => $attr_last_id, "unit" => $attrunit[$key], "value" => $attrval[$key]);

							$this->productdata->insert_product_attribute($data);
						}
					}
				}

				// update product image
				$images = $this->productdata->grab_product_image(array("product_id" => "0", "admin_id" => $this->session->userdata('usrid')));
				if(!empty($images)){
					foreach ($images as $key => $value) {
						if($key == 0){
							$is_featured = 'Y';
						}else{
							$is_featured = 'N';
						}
						$this->productdata->update_product_image(array("product_image_id" => $value->product_image_id), array("product_id" => $prd_last_id, is_featured => $is_featured));
					}
				}
				
				redirect(base_url('admin/product-list'));
			}
		}
		
		public function product_edit($code){
			if($this->session->userdata('has_error')){
				$sess_data = $this->session->userdata;
				$this->data['product_details'] = (object)$sess_data;
				$this->data['entity_id'] = $sess_data['entity_id'];
			}else{
				$cond['slug'] = $code;
				$product_details = $this->productdata->grab_product($cond);
				$this->data['product_details'] = $product_details[0];

				$entity_id = $this->productdata->grab_product_entity_rel(array("product_id" => $product_details[0]->product_id));

				if(!empty($entity_id)){
					foreach ($entity_id as $entity) {
						$entity_arr[] = $entity->entity_id;
					}
				}

				$this->data['entity_id'] = $entity_arr;
			}
			$cat_data = $this->entitydata->grab_entity(array("status" => "Y", "parent_id !=" => "0"), array(), array());
			$this->data['cat_list'] = $cat_data;

			$product_attribute = $this->productdata->grab_product_attribute(array(TABLE_PRODUCT_ATTRIBUTE.".product_id" => $product_details[0]->product_id));
			$this->data['attr_list'] = $product_attribute;

			$unit = $this->config->item('unit');
			$this->data['unit'] = $unit;
			
			$this->load->view('admin/product_edit', $this->data); 
		}
		
		public function edit_product(){
			$post_data = $this->input->post();

			$this->load->library('form_validation');

			if(empty($prd_entity)){
				$this->form_validation->set_rules('entity_id[]', 'Entity', 'trim|required');
			}
			if($post_data['name'] != $post_data['old_name']){
				$this->form_validation->set_rules('name', 'Name', 'trim|required|is_unique['.TABLE_PRODUCT.'.name]');  
			}
			$this->form_validation->set_rules('description', 'Description', 'trim|required');
			$this->form_validation->set_rules('price', 'Price', 'trim|required');
			$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required');
			$this->form_validation->set_rules('sku', 'SKU', 'trim|required');
			$this->form_validation->set_rules('upload_image', 'Upload Images', 'required');

			$attrname = $post_data['attrname'];
			$attrval = $post_data['attrval'];
			$attrunit = $post_data['attrunit'];
			$product_id = $post_data['product_id'];
			$prd_entity = $post_data['entity_id'];
			
			$this->session->unset_userdata($post_data);
			if($this->form_validation->run() == FALSE)
			{	
				$this->session->set_userdata($post_data);
				
				$this->session->set_userdata('has_error', true);
				$this->session->set_userdata('productedit_notification', validation_errors());
				
				redirect($this->agent->referrer());
			}else{
				unset($post_data['attrname']);
				unset($post_data['attrval']);
				unset($post_data['attrunit']);
				unset($post_data['old_name']);
				unset($post_data['product_id']);
				unset($post_data['upload_image']);
				unset($post_data['entity_id']);

				// product
				$slug = $post_data['slug'];
				unset($post_data['slug'])	;
				$post_data['date_modified'] = time();	
				$cond = array("slug" => $slug);

				$this->productdata->update_product($cond, $post_data);

				// product entity
				if(!empty($prd_entity)){
					$this->productdata->delete_product_entity_rel(array("product_id" => $product_id));
					foreach ($prd_entity as $entity) {
						$data = array();
						$data['product_id'] = $product_id;
						$data['entity_id'] = $entity;
						
						$this->productdata->insert_product_entity_rel($data);
					}
				}

				// attribute			
				if(!empty($attrname)){
					foreach ($attrname as $key => $value) {
						if($value){
							$data = array("name" => strtolower(trim($value)));
							$record = $this->productdata->grab_attribute($data);
							if(empty($record)){
								$attr_last_id = $this->productdata->insert_attribute($data);
							}else{
								$attr_last_id = $record[0]->attribute_id;
							}

							$data = array("product_id" => $product_id, "attribute_id" => $attr_last_id, "unit" => $attrunit[$key], "value" => $attrval[$key]);

							$this->productdata->insert_product_attribute($data);
						}
					}
				}

				// update product image
				$images = $this->productdata->grab_product_image(array("product_id" => "0", "admin_id" => $this->session->userdata('usrid')));
				if(!empty($images)){
					foreach ($images as $key => $value) {
						$this->productdata->update_product_image(array("product_image_id" => $value->product_image_id), array("product_id" => $product_id));
					}
				}
				
				redirect(base_url('admin/product-list'));
			}
		}
		
		public function product_delete($code){			
			$cond['slug'] = $code;
			$data['status'] = 'N';

			if($this->productdata->update_product($cond, $data)){
				redirect($this->agent->referrer());
			}
		}

		public function product_attribute_delete(){		
			$post_data = $this->input->post();
			if($this->productdata->delete_product_attribute($post_data)){
				echo 'success';		
			}
		}

		public function save_product_images(){
			$post_data = $this->input->post();
			$uploaded_file = $_FILES['qqfile'];
			$uuid = $post_data['qquuid'];
			$file_name = $post_data['qqfilename'];

			if($uploaded_file['error'] == 0){
				if(move_uploaded_file($uploaded_file['tmp_name'], UPLOAD_RELATIVE_PRODUCT_PATH.$file_name)){

					$this->load->library('image_lib');

					$this->defaultdata->create_thumb(UPLOAD_RELATIVE_PRODUCT_PATH.$file_name, '_s', 165, 250);
					$this->defaultdata->create_thumb(UPLOAD_RELATIVE_PRODUCT_PATH.$file_name, '_m', 210, 250);
					$this->defaultdata->create_thumb(UPLOAD_RELATIVE_PRODUCT_PATH.$file_name, '_l', 270, 400);
					$this->defaultdata->create_thumb(UPLOAD_RELATIVE_PRODUCT_PATH.$file_name, '_xl', 650, 830);	
					
					$data['name'] = $file_name;
					$data['path'] = UPLOAD_RELATIVE_PRODUCT_PATH.$file_name;
					$data['uuid'] = $uuid;
					$data['admin_id'] = $this->session->userdata('usrid');

					if($this->productdata->insert_product_image($data)){
						$response['success'] = true;

						echo json_encode($response);
					}			
				}
			}
		}

		public function get_product_images($product_id){
			$images = $this->productdata->grab_product_image(array("product_id" => $product_id, "admin_id" => $this->session->userdata('usrid')));

			if(!empty($images)){
				foreach ($images as $key => $value) {
					$data[$key]['name'] = $value->name;
					$data[$key]['uuid'] = $value->uuid;
					$data[$key]['thumbnailUrl'] = ROOT_URL.$value->path;
				}
			}else{
				$data = array();
			}

			echo json_encode($data);
		}

		public function delete_thumb($path, $marker){
			$ext = pathinfo($path);
			$thumb_name = $ext['filename'].'_'.$marker.'.'.$ext['extension'];
			$thumb_path = $ext['dirname'].'/'.$thumb_name;
			if(file_exists($thumb_path)){
				if(unlink($thumb_path)){
					return true;
				}
			}
		}

		public function remove_images($images){
			if(!empty($images)){
				foreach ($images as $key => $value) {
					if($this->productdata->delete_product_image(array("product_image_id" => $value->product_image_id))){
						if(file_exists($value->path)){
							if(unlink($value->path)){
								$marker_arr = array('s', 'm', 'l', 'xl');
								if(!empty($marker_arr)){
									foreach ($marker_arr as $marker) {
										$this->delete_thumb($value->path, $marker);
									}
								}								
							}
						}
					}
				}
			}
		}

		public function delete_product_images($uuid){
			// remove entry & images if there is no product_id
			$images = $this->productdata->grab_product_image(array("uuid" => $uuid, "admin_id" => $this->session->userdata('usrid')));
			
			if($this->remove_images($images)){
				$response['success'] = true;

				echo json_encode($response);
			}
		}

		public function unlink_product_image(){		
			// remove entry & images if there is no product_id
			$images = $this->productdata->grab_product_image(array("product_id" => "0", "admin_id" => $this->session->userdata('usrid')));
			
			$this->remove_images($images);
		}

	}