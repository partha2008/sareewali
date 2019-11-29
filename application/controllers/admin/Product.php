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

			$colors = $this->productdata->grab_color();
			$this->data['colors'] = $colors;

			$fabrics = $this->productdata->grab_fabric();
			$this->data['fabrics'] = $fabrics;
			
			$this->load->view('admin/product_add', $this->data); 
		}
		
		public function add_product(){
			$post_data = $this->input->post();

			$search_item = $post_data['search_item'];
			$attrname = $post_data['attrname'];
			$attrval = $post_data['attrval'];
			$attrunit = $post_data['attrunit'];

			unset($post_data['search_item']);
			unset($post_data['attrname']);
			unset($post_data['attrval']);
			unset($post_data['attrunit']);

			if(isset($post_data['entity_id'])){
				$prd_entity = $post_data['entity_id'];
			}
			if(isset($post_data['color'])){
				$color = $post_data['color'];
			}
			if(isset($post_data['tag'])){
				$tags = $post_data['tag'];
			}
			if(isset($post_data['occassion'])){
				$occassions = $post_data['occassion'];
			}

			$this->load->library('form_validation');
			
			if(empty($prd_entity)){
				$this->form_validation->set_rules('entity_id[]', 'Entity', 'trim|required');
			}			
			$this->form_validation->set_rules('name', 'Name', 'trim|required|is_unique['.TABLE_PRODUCT.'.name]');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');
			$this->form_validation->set_rules('note', 'Notes', 'trim|required');
			$this->form_validation->set_rules('price', 'Price', 'trim|required');
			$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required');
			$this->form_validation->set_rules('sku', 'SKU', 'trim|required|is_unique['.TABLE_PRODUCT.'.sku]');
			$this->form_validation->set_rules('content', 'Content', 'trim|required');
			if(empty($color)){
				$this->form_validation->set_rules('color[]', 'Color', 'trim|required');
			}
			$this->form_validation->set_rules('upload_image', 'Upload Images', 'required');			
			
			if($this->form_validation->run() == FALSE)
			{	
				$this->session->unset_userdata($post_data);
				$this->session->set_userdata($post_data);
				$this->session->set_userdata('has_error', true);
				$this->session->set_userdata('productadd_notification', validation_errors());
				
				redirect($this->agent->referrer());
			}else{	
				unset($post_data['upload_image']);
				unset($post_data['entity_id']);
				unset($post_data['color']);
				if(isset($post_data['tag'])){
					unset($post_data['tag']);
				}
				if(isset($post_data['occassion'])){
					unset($post_data['occassion']);
				}
				unset($post_data['rad']);

				// product
				$post_data['slug'] = $this->defaultdata->slugify($post_data['name']);
				$post_data['date_added'] = time();
				if(isset($post_data['prd_dic_chk'])){
					$post_data['prd_dic_chk'] = "Y";
				}else{
					$post_data['prd_dic_chk'] = "N";
				}

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
						$this->productdata->update_product_image(array("product_image_id" => $value->product_image_id), array("product_id" => $prd_last_id, "is_featured" => $is_featured));
					}
				}

				// add product color
				if(!empty($color)){
					foreach ($color as $key => $value) {
						$colors = $this->productdata->grab_color(array("name" => $value));
						if(empty($colors)){
							$last_id = $this->productdata->insert_color(array("name" => $value));
						}else{
							$last_id = $colors[0]->color_id;
						}					

						$this->productdata->insert_product_color(array("product_id" => $prd_last_id, "color_id" => $last_id));
					}
				}

				// add product tag
				if(isset($tags) && !empty($tags)){
					foreach ($tags as $key => $value) {
						$this->productdata->insert_product_tag(array("product_id" => $prd_last_id, "tag_id" =>$value));
					}
				}

				// add product search items
				foreach ($search_item as $key => $value) {
					foreach ($value as $k => $v) {
						$query = $this->db->query("select * from ".TABLE_PREFIX.$key." where name='".$v."' ");
						$result = $query->result();

						if(!empty($result)){
							$k1 = $key.'_id';
							$attr_vl = $result[0]->{$k1};
						}else{
							$query1 = $this->db->query("insert into ".TABLE_PREFIX.$key." (name) values ('".$v."')");	
							$attr_vl = $this->db->insert_id();
						}	
						$query2 = $this->db->query("insert into ".TABLE_PREFIX.'product_'.$key." (".$key."_id, product_id) values (".$attr_vl.", ".$prd_last_id.")");	
					}					
				}				

				// add product occassion
				if(isset($occassions) && !empty($occassions)){
					foreach ($occassions as $key => $value) {
						$this->productdata->insert_product_occassion(array("product_id" => $prd_last_id, "occassion_id" =>$value));
					}
				}
				
				redirect(base_url('admin/product-list'));
			}
		}
		
		public function product_edit($code){
			if($this->session->userdata('has_error')){
				$sess_data = $this->session->userdata;
				$product_details = (object)$sess_data;

				$this->data['product_details'] = $product_details;
				$this->data['entity_id'] = $sess_data['entity_id'];
				if(isset($product_details->tag)){
					$this->data['tags_sess'] = $product_details->tag;
				}
				$this->data['occassions'] = $product_details->occassion;
			}else{
				$cond['slug'] = $code;
				$product_details = $this->productdata->grab_product($cond);
				$this->data['product_details'] = $product_details[0];
				$product_details = $product_details[0];

				$entity_id = $this->productdata->grab_product_entity_rel(array("product_id" => $product_details->product_id));

				if(!empty($entity_id)){
					foreach ($entity_id as $entity) {
						$entity_arr[] = $entity->entity_id;
					}
				}

				$this->data['entity_id'] = $entity_arr;

				$product_colors = $this->productdata->grab_product_color(array("product_id" => $product_details->product_id));
				if(!empty($product_colors)){
					foreach ($product_colors as $key => $value) {
						$selected_colors[] = $value->color_id;
					}				
				}
				$this->data['selected_colors'] = $selected_colors;

				$tags = $this->productdata->grab_product_tag(array("product_id" => $product_details->product_id));
				$this->data['tags'] = $tags;

				$occassion = array();
				$occassions = $this->productdata->grab_product_occassion(array("product_id" => $product_details->product_id));
				if(!empty($occassions)){
					foreach ($occassions as $key => $value) {
						$occassion[] = $value->occassion_id;
					}
				}
				$this->data['occassions'] = $occassion;
			}
			$cat_data = $this->entitydata->grab_entity(array("status" => "Y", "parent_id !=" => "0"), array(), array());
			$this->data['cat_list'] = $cat_data;

			$product_attribute = $this->productdata->grab_product_attribute(array(TABLE_PRODUCT_ATTRIBUTE.".product_id" => $product_details->product_id));
			$this->data['attr_list'] = $product_attribute;

			$unit = $this->config->item('unit');
			$this->data['unit'] = $unit;

			$colors = $this->productdata->grab_color();
			$this->data['colors'] = $colors;
			
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
			$this->form_validation->set_rules('note', 'Notes', 'trim|required');
			$this->form_validation->set_rules('price', 'Price', 'trim|required');
			$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required');
			$this->form_validation->set_rules('sku', 'SKU', 'trim|required');
			if(empty($color)){
				$this->form_validation->set_rules('color[]', 'Color', 'trim|required');
			}
			$this->form_validation->set_rules('content', 'Content', 'trim|required');
			$this->form_validation->set_rules('upload_image', 'Upload Images', 'required');

			$search_item = $post_data['search_item'];
			unset($post_data['search_item']);
			$attrname = $post_data['attrname'];
			unset($post_data['attrname']);
			$attrval = $post_data['attrval'];
			unset($post_data['attrval']);
			$attrunit = $post_data['attrunit'];
			unset($post_data['attrunit']);
			$product_id = $post_data['product_id'];
			$prd_entity = $post_data['entity_id'];
			$color = $post_data['color'];
			if(isset($post_data['tag'])){
				$tags = $post_data['tag'];
			}
			if(isset($post_data['occassion'])){
				$occassions = $post_data['occassion'];
			}
			
			$this->session->unset_userdata($post_data);
			if($this->form_validation->run() == FALSE)
			{	
				$this->session->set_userdata($post_data);
				
				$this->session->set_userdata('has_error', true);
				$this->session->set_userdata('productedit_notification', validation_errors());
				
				redirect($this->agent->referrer());
			}else{
				unset($post_data['old_name']);
				unset($post_data['product_id']);
				unset($post_data['upload_image']);
				unset($post_data['entity_id']);
				unset($post_data['color']);
				if(isset($post_data['tag'])){
					unset($post_data['tag']);
				}
				if(isset($post_data['occassion'])){
					unset($post_data['occassion']);
				}
				unset($post_data['rad']);

				// product
				$slug = $post_data['slug'];
				unset($post_data['slug'])	;
				$post_data['date_modified'] = time();	
				if(isset($post_data['prd_dic_chk'])){
					$post_data['prd_dic_chk'] = "Y";
				}else{
					$post_data['prd_dic_chk'] = "N";
				}
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
						if($key == 0){
							$selected_product_image_id = $value->product_image_id;
						}
						$this->productdata->update_product_image(array("product_image_id" => $value->product_image_id), array("product_id" => $product_id));
					}
				}

				$images = $this->productdata->grab_product_image(array("product_id" => $product_id, "admin_id" => $this->session->userdata('usrid'), "is_featured" => "Y"));

				if(empty($images)){
					$this->productdata->update_product_image(array("product_image_id" => $selected_product_image_id), array("is_featured" => "Y"));
				}

				// delete product color
				$this->productdata->delete_product_color(array("product_id" => $product_id));

				// add product color
				if(!empty($color)){
					foreach ($color as $key => $value) {
						$colors = $this->productdata->grab_color(array("name" => $value));
						if(empty($colors)){
							$last_id = $this->productdata->insert_color(array("name" => $value));
						}else{
							$last_id = $colors[0]->color_id;
						}					

						$this->productdata->insert_product_color(array("product_id" => $product_id, "color_id" => $last_id));
					}
				}

				// delete product tag
				$this->productdata->delete_product_tag(array("product_id" => $product_id));

				// add product tag
				if(isset($tags) && !empty($tags)){
					foreach ($tags as $key => $value) {
						$this->productdata->insert_product_tag(array("product_id" => $product_id, "tag_id" =>$value));
					}
				}

				/*// add product search items
				foreach ($search_item as $key => $value) {
					foreach ($value as $k => $v) {
						$this->db->query("delete from ".TABLE_PREFIX.'product_'.$key." where  product_id='".$prd_last_id."' ");

						$query = $this->db->query("select * from ".TABLE_PREFIX.$key." where name='".$v."' ");
						$result = $query->result();

						if(!empty($result)){
							$k1 = $key.'_id';
							$attr_vl = $result[0]->{$k1};
						}else{
							$query1 = $this->db->query("insert into ".TABLE_PREFIX.$key." (name) values ('".$v."')");	
							$attr_vl = $this->db->insert_id();
						}	
						$query2 = $this->db->query("insert into ".TABLE_PREFIX.'product_'.$key." (".$key."_id, product_id) values (".$attr_vl.", ".$prd_last_id.")");	
					}					
				}*/

				// delete product occassion
				$this->productdata->delete_product_occassion(array("product_id" => $product_id));

				// add product occassion
				if(isset($occassions) && !empty($occassions)){
					foreach ($occassions as $key => $value) {
						$this->productdata->insert_product_occassion(array("product_id" => $product_id, "occassion_id" =>$value));
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
					$data[$key]['product_image_id'] = $value->product_image_id;
					$data[$key]['is_featured'] = $value->is_featured;
					$data[$key]['product_id'] = $value->product_id;
				}
			}else{
				$data = array();
			}

			echo json_encode($data);
		}

		public function make_product_image_featured(){
			$post_data = $this->input->post();
			if($this->productdata->update_product_image(array("product_id" => $post_data['product_id']), array("is_featured" => "N"))){
				if($this->productdata->update_product_image(array("product_image_id" => $post_data['val']), array("is_featured" => "Y"))){
					echo "success";
				}else{
					echo "failure";
				}
			}else{
				echo "failure";
			}
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

			return true;
		}

		public function delete_product_images($uuid){
			// remove entry & images if there is no product_id
			$images = $this->productdata->grab_product_image(array("uuid" => $uuid, "admin_id" => $this->session->userdata('usrid')));
			
			if($this->remove_images($images)){
				// update product image is_featured
				$counter = 0;
				$images = $this->productdata->grab_product_image(array("product_id" => $images[0]->product_id, "admin_id" => $this->session->userdata('usrid')));
				if(!empty($images)){					
					foreach ($images as $key => $value) {
						if($key == 0){
							$product_image_id = $value->product_image_id;
						}
						if($value->is_featured != "Y"){
							$counter++;
						}						
					}
				}
				if($counter > 0){
					$this->productdata->update_product_image(array("product_image_id" => $product_image_id), array("is_featured" => "Y"));
					$response['product_image_id'] = $product_image_id;
				}else{
					$response['product_image_id'] = '';
				}				
				$response['success'] = true;

				echo json_encode($response);
			}
		}

		public function unlink_product_image(){		
			// remove entry & images if there is no product_id
			$images = $this->productdata->grab_product_image(array("product_id" => "0", "admin_id" => $this->session->userdata('usrid')));
			
			$this->remove_images($images);
		}

		public function modify_product_price(){
			$post_data = $this->input->post();

			if($post_data['mode'] == "flat"){
                $discounted_price = $post_data['prd_amt']-$post_data['prd_dis_amt'];
            }else{
                $dis = $post_data['prd_amt']*$post_data['prd_dis_amt']/100;
                $discounted_price = $post_data['prd_amt']-$dis;
            }

			echo number_format($discounted_price, 0, '', '');
		}

	}