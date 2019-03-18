<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Review extends CI_Controller{
	
	public $data = array();
	public $loggedin_method_arr = array('review-list', 'review-add', 'review-edit');
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('reviewdata');
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
	
	public function review_list(){
		$like = array();
		parse_str($_SERVER['QUERY_STRING'], $like);
		unset($like['page']);
		
		$search_key = $this->input->get('reviewer');
		if(isset($search_key) && $search_key){
			$this->data['search_key'] = $search_key;
		}else{
			$this->data['search_key'] = '';
		}
		
		$review_data = $this->reviewdata->grab_review(array(), $like, array());
		
		//pagination settings
		$config['base_url'] = base_url('admin/review-list');
		$config['total_rows'] = count($review_data);
		
		$pagination = $this->config->item('pagination');
		
		$pagination = array_merge($config, $pagination);

		$this->pagination->initialize($pagination);
		$this->data['page'] = ($this->input->get('page')) ? $this->input->get('page') : 0;		

		$this->data['pagination'] = $this->pagination->create_links();
		
		$review_paginated_data = $this->reviewdata->grab_review(array(), $like, array(PAGINATION_PER_PAGE, $this->data['page']));
		$this->data['review_details'] = $review_paginated_data;
		
		$this->load->view('admin/review_list', $this->data); 
	}
	
	public function review_add(){
		if($this->session->userdata('has_error')){
			$this->data['review_data'] = (object)$this->session->userdata;
		}

		$state_data = $this->defaultdata->grabStateData(array("country_id" => 101));
		$this->data['state_data'] = $state_data;

		$product_data = $this->productdata->grab_product();
		$this->data['product_data'] = $product_data;

		$this->load->view('admin/review_add', $this->data); 
	}
	
	public function add_review(){
		$post_data = $this->input->post();
			
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('reviewer', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required');
		$this->form_validation->set_rules('state_id', 'State', 'trim|required');
		$this->form_validation->set_rules('review', 'Review', 'trim|required');	
		$this->form_validation->set_rules('product_id', 'Product', 'trim|required');
		$this->form_validation->set_rules('rating', 'Rating', 'trim|required');	
		
		$this->session->unset_userdata($post_data);
		if($this->form_validation->run() == FALSE)
		{	
			$this->session->set_userdata($post_data);
			$this->session->set_userdata('has_error', true);
			$this->session->set_userdata('review_notification', validation_errors());
			
			redirect($this->agent->referrer());
		}else{
			$post_data['date_added'] = time();

			$this->reviewdata->insert_review($post_data);
			
			redirect(base_url('admin/review-list'));
		}
	}
	
	public function review_edit($review_id){
		if($this->session->userdata('has_error')){
			$this->data['review_data'] = (object)$this->session->userdata;
		}else{
			$cond['review_id'] = $review_id;
			$review_details = $this->reviewdata->grab_review($cond);
			$this->data['review_data'] = $review_details[0];
		}

		$state_data = $this->defaultdata->grabStateData(array("country_id" => 101));
		$this->data['state_data'] = $state_data;

		$product_data = $this->productdata->grab_product();
		$this->data['product_data'] = $product_data;
		
		$this->load->view('admin/review_edit', $this->data); 
	}
	
	public function edit_review(){
		$post_data = $this->input->post();
			
		$this->load->library('form_validation');

		$this->form_validation->set_rules('reviewer', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required');
		$this->form_validation->set_rules('state_id', 'State', 'trim|required');
		$this->form_validation->set_rules('review', 'Review', 'trim|required');	
		$this->form_validation->set_rules('product_id', 'Product', 'trim|required');
		$this->form_validation->set_rules('rating', 'Rating', 'trim|required');	
		
		$this->session->unset_userdata($post_data);
		if($this->form_validation->run() == FALSE)
		{	
			$this->session->set_userdata($post_data);
			
			$this->session->set_userdata('has_error', true);
			$this->session->set_userdata('review_notification', validation_errors());
			
			redirect($this->agent->referrer());
		}else{
			$post_data['date_modified'] = time();
			$review_id = $post_data['review_id'];
			unset($post_data['review_id']);

			$this->reviewdata->update_review(array("review_id" => $review_id), $post_data);
			
			redirect(base_url('admin/review-list'));
		}
	}

	public function review_update($review_id){			
		$cond['review_id'] = $review_id;
		$data['status'] = 'N';
		
		if($this->reviewdata->update_review($cond, $data)){
			redirect($this->agent->referrer());		
		}
	}
}