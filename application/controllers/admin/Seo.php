<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seo extends CI_Controller{
	
	public $data = array();
	
	public function __construct(){
		parent::__construct();

		$this->load->model('seodata');
			
		$this->data = $this->defaultdata->getBackendDefaultData();
	}

	public function index(){
		if($this->input->get('page')){
			$seo_data = $this->seodata->grab_seo(array("page_value" => $this->input->get('page')));
		}else{
			$seo_data = $this->seodata->grab_seo();
		}
		//echo "<pre>";print_r($seo_data);die();

		$pages = $this->seodata->grab_seo();
		
		$this->data['pages'] = $pages;
		$this->data['seo_data'] = $seo_data[0];

		$this->load->view('admin/seo', $this->data); 
	}
	
	public function update_seo(){
		$post_data = $this->input->post();

		$page_value = $post_data['page_value'];
		unset($post_data['page_value']);

		$this->seodata->update_seo(array("page_value" => $page_value), $post_data);
		
		redirect($this->agent->referrer());
	}
}