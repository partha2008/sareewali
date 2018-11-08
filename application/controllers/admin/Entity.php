<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Entity extends CI_Controller{
	
	public $data = array();
	public $loggedin_method_arr = array('entity-list', 'entity-add', 'entity-edit');
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('entitydata');
		$this->load->model('productdata');
			
		$this->data = $this->defaultdata->getBackendDefaultData();
		
		if(in_array($this->data['tot_segments'][1], $this->loggedin_method_arr))
		{
			if($this->defaultdata->is_session_active() == 0)
			{
				redirect(base_url());
			}
		}
	}
	
	public function entity_list(){
		$like = array();
		parse_str($_SERVER['QUERY_STRING'], $like);
		unset($like['page']);
		
		$search_key = $this->input->get('name');
		if(isset($search_key) && $search_key){
			$this->data['search_key'] = $search_key;
		}else{
			$this->data['search_key'] = '';
		}
		
		$entity_data = $this->entitydata->grab_entity(array("parent_id !=" => "0"), $like, array());
		
		//pagination settings
		$config['base_url'] = site_url('entity-list');
		$config['total_rows'] = count($entity_data);
		
		$pagination = $this->config->item('pagination');
		
		$pagination = array_merge($config, $pagination);

		$this->pagination->initialize($pagination);
		$this->data['page'] = ($this->input->get('page')) ? $this->input->get('page') : 0;		

		$this->data['pagination'] = $this->pagination->create_links();
		
		$entity_paginated_data = $this->entitydata->grab_entity(array("parent_id !=" => "0"), $like, array(PAGINATION_PER_PAGE, $this->data['page']));
		$this->data['entity_details'] = $entity_paginated_data;
		
		$this->load->view('admin/entity_list', $this->data); 
	}
	
	public function entity_add(){
		if($this->session->userdata('has_error')){
			$this->data['cat_details'] = (object)$this->session->userdata;
		}

		$entity_data = $this->entitydata->grab_entity();
		$this->data['entity_data'] = $entity_data;

		$this->load->view('admin/entity_add', $this->data); 
	}

	public function file_check(){
		$uploaded_file = $_FILES['image_path'];

		$file_name = $uploaded_file['name'];
        $allowed_mime_type_arr = array('image/jpeg','image/pjpeg');
        $mime = get_mime_by_extension($file_name);
        if(isset($file_name) && $file_name != ""){
            if(in_array($mime, $allowed_mime_type_arr)){
				list($width, $height) = getimagesize($uploaded_file['tmp_name']);
				if($width < 560 && $height < 472) {
				    $this->form_validation->set_message('file_check', 'The file should be minimum 560 x 472 (px)');
                	return false;
				}else{
					return true;
				}                
            }else{
                $this->form_validation->set_message('file_check', 'Please select only jpg file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }
	
	public function add_entity(){
		$post_data = $this->input->post();
			
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name', 'Entity Name', 'trim|required|is_unique['.TABLE_ENTITY.'.name]');
		$this->form_validation->set_rules('entity_id', 'Parent', 'required');
		
		if($_FILES['image_path']['name']){
			$this->form_validation->set_rules('image_path', 'Image', 'callback_file_check');	
		}
		
		$this->session->unset_userdata($post_data);
		if($this->form_validation->run() == FALSE)
		{	
			$this->session->set_userdata($post_data);
			$this->session->set_userdata('has_error', true);
			$this->session->set_userdata('catadd_notification', validation_errors());
			
			redirect($this->agent->referrer());
		}else{
			$image_path = '';
			if($_FILES['image_path']['name']){
				$file_ext = strtolower(pathinfo($_FILES['image_path']['name'], PATHINFO_EXTENSION));
				$new_file_only_name = md5(time());
				$new_file_name = $new_file_only_name.'.'.$file_ext;

				if(move_uploaded_file($_FILES['image_path']['tmp_name'], UPLOAD_RELATIVE_ENTITY_PATH.$new_file_name)){
					$this->load->library('image_lib');

					$this->defaultdata->create_thumb(UPLOAD_RELATIVE_ENTITY_PATH.$new_file_name, '_s', 270, 230);
					$this->defaultdata->create_thumb(UPLOAD_RELATIVE_ENTITY_PATH.$new_file_name, '_m', 560, 204);
					$this->defaultdata->create_thumb(UPLOAD_RELATIVE_ENTITY_PATH.$new_file_name, '_l', 540, 472);

					$image_path = $new_file_name;
				}
			}

			$slug = $this->defaultdata->slugify($post_data['name']);
			$entity_id = explode("||", $post_data['entity_id']);
			$data = array(
				"name" => $post_data['name'],
				"description" => $post_data['description'],
				"image_path" => $image_path,
				"slug" => $slug,
				"level" => $entity_id[1]+1,
				"parent_id" => $entity_id[0],
				"sort_order" => $post_data['sort_order'],
				"is_special" => $post_data['is_special'],				
				"status" => $post_data['status'],
				"date_added" => time()
			);
			$this->entitydata->insert_entity($data);
			
			$this->session->set_userdata('has_error', false);
			
			redirect(base_url('admin/entity-list'));
		}
	}
	
	public function entity_edit($code){
		if($this->session->userdata('has_error')){
			$this->data['cat_details'] = (object)$this->session->userdata;
		}else{
			$cond['slug'] = $code;
			$cat_details = $this->entitydata->grab_entity($cond);
			$this->data['cat_details'] = $cat_details[0];
		}

		$entity_data = $this->entitydata->grab_entity(array("slug !=" => $code));
		$this->data['entity_data'] = $entity_data;
		
		$this->load->view('admin/entity_edit', $this->data); 
	}
	
	public function edit_entity(){
		$post_data = $this->input->post();
			
		$this->load->library('form_validation');
		
		if($post_data['name'] != $post_data['old_categoryname']){
			$is_unique =  '|is_unique['.TABLE_ENTITY.'.name]';
		}else{
			$is_unique =  '';
		}
		$this->form_validation->set_rules('name', 'Entity Name', 'trim|required'.$is_unique);	
		$this->form_validation->set_rules('entity_id', 'Parent', 'required');	
		if($_FILES['image_path']['name']){
			$this->form_validation->set_rules('image_path', 'Image', 'callback_file_check');	
		}
		
		$this->session->unset_userdata($post_data);
		if($this->form_validation->run() == FALSE)
		{	
			$this->session->set_userdata($post_data);
			
			$this->session->set_userdata('has_error', true);
			$this->session->set_userdata('catedit_notification', validation_errors());
			
			redirect($this->agent->referrer());
		}else{
			$image_path = $post_data['hidden_image_path'];
			
			if($_FILES['image_path']['name']){
				$file_ext = strtolower(pathinfo($_FILES['image_path']['name'], PATHINFO_EXTENSION));
				$new_file_only_name = md5(time());
				$new_file_name = $new_file_only_name.'.'.$file_ext;

				if(move_uploaded_file($_FILES['image_path']['tmp_name'], UPLOAD_RELATIVE_ENTITY_PATH.$new_file_name)){
					$this->load->library('image_lib');

					$this->defaultdata->create_thumb(UPLOAD_RELATIVE_ENTITY_PATH.$new_file_name, '_s', 270, 230);
					$this->defaultdata->create_thumb(UPLOAD_RELATIVE_ENTITY_PATH.$new_file_name, '_m', 560, 204);
					$this->defaultdata->create_thumb(UPLOAD_RELATIVE_ENTITY_PATH.$new_file_name, '_l', 540, 472);

					$image_path = $new_file_name;
				}

				// remove previous image
				if(file_exists(UPLOAD_RELATIVE_ENTITY_PATH.$post_data['hidden_image_path'])){
					unlink(UPLOAD_RELATIVE_ENTITY_PATH.$post_data['hidden_image_path']);
				}

				
				$file_ext_ = strtolower(pathinfo($post_data['hidden_image_path'], PATHINFO_EXTENSION));
				$file_name_ = basename($post_data['hidden_image_path'], '.'.$file_ext_);

				$small_file_with_ext = $file_name_.'_s.'.$file_ext_;
				if(file_exists(UPLOAD_RELATIVE_ENTITY_PATH.$small_file_with_ext)){
					unlink(UPLOAD_RELATIVE_ENTITY_PATH.$small_file_with_ext);
				}

				$medium_file_with_ext = $file_name_.'_m.'.$file_ext_;
				if(file_exists(UPLOAD_RELATIVE_ENTITY_PATH.$medium_file_with_ext)){
					unlink(UPLOAD_RELATIVE_ENTITY_PATH.$medium_file_with_ext);
				}

				$large_file_with_ext = $file_name_.'_l.'.$file_ext_;
				if(file_exists(UPLOAD_RELATIVE_ENTITY_PATH.$large_file_with_ext)){
					unlink(UPLOAD_RELATIVE_ENTITY_PATH.$large_file_with_ext);
				}
			}
			unset($post_data['hidden_image_path']);

			$cond['slug'] = $post_data['slug'];
			$entity_id = explode("||", $post_data['entity_id']);
			$data = array(
				"name" => $post_data['name'],
				"description" => $post_data['description'],
				"image_path" => $image_path,
				"level" => $entity_id[1]+1,
				"parent_id" => $entity_id[0],
				"sort_order" => $post_data['sort_order'],
				"is_special" => $post_data['is_special'],							
				"status" => $post_data['status'],
				"date_modified" => time()
			);
			$this->entitydata->update_entity($cond, $data);

			if(isset($post_data['prd_dic_chk']) && ($post_data['prd_dic_chk'] == "Y")){
				if($post_data['prd_dis_amt']){
					$primary_key = $post_data['primary_key'];
					$prd_entity = $this->productdata->grab_product_entity_rel(array("entity_id" => $primary_key));

					if(!empty($prd_entity)){
						foreach ($prd_entity as $key => $value) {
							if($post_data['prd_dis_mode'] == "flat"){
								$this->db->query("UPDATE ".TABLE_PRODUCT." SET discounted_price=CASE WHEN ".$post_data['prd_dis_amt']." > price THEN 0 ELSE price - ".$post_data['prd_dis_amt']." END, prd_dic_chk = 'Y', prd_dis_mode = '".$post_data['prd_dis_mode']."', prd_dis_amt=".$post_data['prd_dis_amt'].", date_modified = ".time()." WHERE product_id='".$value->product_id."' ");
							}else{
								$this->db->query("UPDATE ".TABLE_PRODUCT." SET discounted_price=price - (price*".$post_data['prd_dis_amt']."/100), prd_dic_chk = 'Y', prd_dis_mode = '".$post_data['prd_dis_mode']."', prd_dis_amt=".$post_data['prd_dis_amt'].", date_modified = ".time()." WHERE product_id='".$value->product_id."' ");
							}
						}
					}					
				}				
			}
			
			redirect(base_url('admin/entity-list'));
		}
	}

	public function entity_update($code){			
		$cond['slug'] = $code;
		$data['status'] = 'N';
		
		if($this->entitydata->update_entity($cond, $data)){
			redirect($this->agent->referrer());		
		}
	}

	public function entity_relation(){
		$tree = $this->entitydata->grab_entity();
		$recArr = array();

		if(!empty($tree)){
			foreach($tree as $tr){
				$recArr[$tr->entity_id] = $tr;
			}
		}

		if(!empty($tree)){
			foreach($tree as $tr){
				$recArr[$tr->entity_id] = $tr;
				if($tr->parent_id == 0){
					$final_tree[$tr->name] = null;
				}else{
					$final_tree[$tr->name] = $recArr[$tr->parent_id]->name;
				}
			}
		}

		$this->data['final_tree'] = $this->defaultdata->parseTree($final_tree);

		echo $this->load->view('admin/partials/relation', $this->data, true);
	}
}