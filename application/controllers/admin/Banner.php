<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner extends CI_Controller{
	
	public $data = array();
	public $loggedin_method_arr = array('entity-list', 'entity-add', 'entity-edit');
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('bannerdata');
			
		$this->data = $this->defaultdata->getBackendDefaultData();
		
		if(in_array($this->data['tot_segments'][1], $this->loggedin_method_arr))
		{
			if($this->defaultdata->is_session_active() == 0)
			{
				redirect(base_url());
			}
		}
	}
	
	public function banner_list(){
		$like = array();
		parse_str($_SERVER['QUERY_STRING'], $like);
		unset($like['page']);
		
		$search_key = $this->input->get('title');
		if(isset($search_key) && $search_key){
			$this->data['search_key'] = $search_key;
		}else{
			$this->data['search_key'] = '';
		}
		
		$banner_data = $this->bannerdata->grab_banner(array(), $like, array());
		
		//pagination settings
		$config['base_url'] = base_url('admin/banner-list');
		$config['total_rows'] = count($banner_data);
		
		$pagination = $this->config->item('pagination');
		
		$pagination = array_merge($config, $pagination);

		$this->pagination->initialize($pagination);
		$this->data['page'] = ($this->input->get('page')) ? $this->input->get('page') : 0;		

		$this->data['pagination'] = $this->pagination->create_links();
		
		$entity_paginated_data = $this->bannerdata->grab_banner(array(), $like, array(PAGINATION_PER_PAGE, $this->data['page']));
		$this->data['banner_details'] = $entity_paginated_data;
		
		$this->load->view('admin/banner_list', $this->data); 
	}
	
	public function banner_add(){
		if($this->session->userdata('has_error')){
			$this->data['banner_details'] = (object)$this->session->userdata;
		}

		$banner_data = $this->bannerdata->grab_banner();
		$this->data['banner_data'] = $banner_data;

		$this->load->view('admin/banner_add', $this->data); 
	}

	public function file_check(){
		$uploaded_file = $_FILES['path'];

		$file_name = $uploaded_file['name'];
        $allowed_mime_type_arr = array('image/jpeg','image/pjpeg');
        $mime = get_mime_by_extension($file_name);
        if(isset($file_name) && $file_name != ""){
            if(in_array($mime, $allowed_mime_type_arr)){
				list($width, $height) = getimagesize($uploaded_file['tmp_name']);
				if($width < 1200 && $height < 400) {
				    $this->form_validation->set_message('file_check', 'The file should be minimum 1200 x 400 (px)');
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
	
	public function add_banner(){
		$post_data = $this->input->post();
			
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('description', 'Description', 'trim|required');
		$this->form_validation->set_rules('path', 'Banner', 'callback_file_check');		
		
		$this->session->unset_userdata($post_data);
		if($this->form_validation->run() == FALSE)
		{	
			$this->session->set_userdata($post_data);
			$this->session->set_userdata('has_error', true);
			$this->session->set_userdata('banner_notification', validation_errors());
			
			redirect($this->agent->referrer());
		}else{
			$file_ext = strtolower(pathinfo($_FILES['path']['name'], PATHINFO_EXTENSION));
			$new_file_only_name = md5(time());
			$new_file_name = $new_file_only_name.'.'.$file_ext;

			if(move_uploaded_file($_FILES['path']['tmp_name'], UPLOAD_RELATIVE_BANNER_PATH.$new_file_name)){
				$post_data['path'] = UPLOAD_RELATIVE_BANNER_PATH.$new_file_name;
				$post_data['date_added'] = time();

				$this->bannerdata->insert_banner($post_data);
				
				redirect(base_url('admin/banner-list'));
			}
		}
	}
	
	public function banner_edit($banner_id){
		if($this->session->userdata('has_error')){
			$this->data['banner_data'] = (object)$this->session->userdata;
		}else{
			$cond['banner_id'] = $banner_id;
			$banner_details = $this->bannerdata->grab_banner($cond);
			$this->data['banner_data'] = $banner_details[0];
		}

		$banner_data = $this->bannerdata->grab_banner();
		$this->data['banner_count'] = count($banner_data);
		
		$this->load->view('admin/banner_edit', $this->data); 
	}
	
	public function edit_banner(){
		$post_data = $this->input->post();
			
		$this->load->library('form_validation');

		$this->form_validation->set_rules('title', 'Title', 'trim|required');	
		$this->form_validation->set_rules('description', 'Description', 'trim|required');
		if($_FILES['path']['name'] != ''){
			$this->form_validation->set_rules('path', 'Banner', 'callback_file_check');
		}
		
		$this->session->unset_userdata($post_data);
		if($this->form_validation->run() == FALSE)
		{	
			$this->session->set_userdata($post_data);
			
			$this->session->set_userdata('has_error', true);
			$this->session->set_userdata('banner_notification', validation_errors());
			
			redirect($this->agent->referrer());
		}else{
			if($_FILES['path']['name'] != ''){
				$file_ext = strtolower(pathinfo($_FILES['path']['name'], PATHINFO_EXTENSION));
				$new_file_only_name = md5(time());
				$new_file_name = $new_file_only_name.'.'.$file_ext;

				if(move_uploaded_file($_FILES['path']['tmp_name'], UPLOAD_RELATIVE_BANNER_PATH.$new_file_name)){
					$post_data['path'] = UPLOAD_RELATIVE_BANNER_PATH.$new_file_name;
					$post_data['date_modified'] = time();
					$banner_id = $post_data['banner_id'];
					unset($post_data['banner_id']);

					$this->bannerdata->update_banner(array("banner_id" => $banner_id), $post_data);
					
					redirect(base_url('admin/banner-list'));
				}	
			}else{
				$post_data['date_modified'] = time();
				$banner_id = $post_data['banner_id'];
				unset($post_data['banner_id']);

				$this->bannerdata->update_banner(array("banner_id" => $banner_id), $post_data);
				
				redirect(base_url('admin/banner-list'));
			}		
		}
	}

	public function banner_update($banner_id){			
		$cond['banner_id'] = $banner_id;
		$data['status'] = 'N';
		
		if($this->bannerdata->update_banner($cond, $data)){
			redirect($this->agent->referrer());		
		}
	}
}