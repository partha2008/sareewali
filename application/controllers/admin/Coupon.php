<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coupon extends CI_Controller{
	
	public $data = array();
	public $loggedin_method_arr = array('coupon-list', 'coupon-add', 'coupon-edit');
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('coupondata');
			
		$this->data = $this->defaultdata->getBackendDefaultData();
		
		if(in_array($this->data['tot_segments'][1], $this->loggedin_method_arr))
		{
			if($this->defaultdata->is_session_active() == 0)
			{
				redirect(base_url());
			}
		}
	}
	
	public function coupon_list(){
		$like = array();
		parse_str($_SERVER['QUERY_STRING'], $like);
		unset($like['page']);
		
		$search_key = $this->input->get('code');
		if(isset($search_key) && $search_key){
			$this->data['search_key'] = $search_key;
		}else{
			$this->data['search_key'] = '';
		}
		
		$coupon_data = $this->coupondata->grab_coupon(array(), $like, array());
		
		//pagination settings
		$config['base_url'] = site_url('coupon-list');
		$config['total_rows'] = count($coupon_data);
		
		$pagination = $this->config->item('pagination');
		
		$pagination = array_merge($config, $pagination);

		$this->pagination->initialize($pagination);
		$this->data['page'] = ($this->input->get('page')) ? $this->input->get('page') : 0;		

		$this->data['pagination'] = $this->pagination->create_links();
		
		$coupon_paginated_data = $this->coupondata->grab_coupon(array(), $like, array(PAGINATION_PER_PAGE, $this->data['page']));
		$this->data['coupon_details'] = $coupon_paginated_data;
		
		$this->load->view('admin/coupon_list', $this->data); 
	}
	
	public function coupon_add(){
		if($this->session->userdata('has_error')){
			$this->data['coupon_data'] = (object)$this->session->userdata;
		}

		$this->load->view('admin/coupon_add', $this->data); 
	}
	
	public function add_coupon(){
		$post_data = $this->input->post();
			
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('code', 'Code', 'trim|required');
		$this->form_validation->set_rules('discount', 'Discount', 'trim|required');
		
		$this->session->unset_userdata($post_data);
		if($this->form_validation->run() == FALSE)
		{	
			$this->session->set_userdata($post_data);
			$this->session->set_userdata('has_error', true);
			$this->session->set_userdata('coupon_notification', validation_errors());
			
			redirect($this->agent->referrer());
		}else{
			$post_data['date_added'] = time();

			$this->coupondata->insert_coupon($post_data);
			
			redirect(base_url('admin/coupon-list'));
		}
	}
	
	public function coupon_edit($coupon_id){
		if($this->session->userdata('has_error')){
			$this->data['coupon_data'] = (object)$this->session->userdata;
		}else{
			$cond['coupon_id'] = $coupon_id;
			$coupon_details = $this->coupondata->grab_coupon($cond);
			$this->data['coupon_data'] = $coupon_details[0];
		}
		
		$this->load->view('admin/coupon_edit', $this->data); 
	}
	
	public function edit_coupon(){
		$post_data = $this->input->post();
			
		$this->load->library('form_validation');

		$this->form_validation->set_rules('code', 'Code', 'trim|required');
		$this->form_validation->set_rules('discount', 'Discount', 'trim|required');
		
		$this->session->unset_userdata($post_data);
		if($this->form_validation->run() == FALSE)
		{	
			$this->session->set_userdata($post_data);
			
			$this->session->set_userdata('has_error', true);
			$this->session->set_userdata('coupon_notification', validation_errors());
			
			redirect($this->agent->referrer());
		}else{
			$post_data['date_modified'] = time();
			$coupon_id = $post_data['coupon_id'];
			unset($post_data['coupon_id']);

			$this->coupondata->update_coupon(array("coupon_id" => $coupon_id), $post_data);
			
			redirect(base_url('admin/coupon-list'));
		}
	}

	public function coupon_update($coupon_id){			
		$cond['coupon_id'] = $coupon_id;
		$data['status'] = 'N';
		
		if($this->coupondata->update_coupon($cond, $data)){
			redirect($this->agent->referrer());		
		}
	}
}