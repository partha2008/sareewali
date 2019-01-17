<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller{
	
	public $data = array();
	public $loggedin_method_arr = array('order-list', 'order-add', 'order-edit');
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('orderdata');
			
		$this->data = $this->defaultdata->getBackendDefaultData();
		
		if(in_array($this->data['tot_segments'][1], $this->loggedin_method_arr))
		{
			if($this->defaultdata->is_session_active() == 0)
			{
				redirect(base_url());
			}
		}
	}
	
	public function order_list(){		
		$search_key = $this->input->get('query');
		$like = array(
			"first_name" => $search_key,
			"last_name" => $search_key,
			"transaction_id" => $search_key,
			"payment_type" => $search_key
		);
		if(isset($search_key) && $search_key){
			$this->data['search_key'] = $search_key;
		}else{
			$this->data['search_key'] = '';
		}
		
		$order_data = $this->orderdata->grab_order(array(), $like, array());
		
		//pagination settings
		$config['base_url'] = site_url('order-list');
		$config['total_rows'] = count($order_data);
		
		$pagination = $this->config->item('pagination');
		
		$pagination = array_merge($config, $pagination);

		$this->pagination->initialize($pagination);
		$this->data['page'] = ($this->input->get('page')) ? $this->input->get('page') : 0;		

		$this->data['pagination'] = $this->pagination->create_links();
		
		$order_paginated_data = $this->orderdata->grab_order(array(), $like, array(PAGINATION_PER_PAGE, $this->data['page']));
		$this->data['order_details'] = $order_paginated_data;
		
		$this->load->view('admin/order_list', $this->data); 
	}
}